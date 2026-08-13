import './bootstrap';
import Cropper from 'cropperjs';
import 'cropperjs/dist/cropper.css';

document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.getElementById('profile_image');
    const preview = document.getElementById('profile-image-preview');
    const placeholder = document.getElementById(
        'profile-image-placeholder'
    );
    const fileName = document.getElementById('profile-image-name');
    const editButton = document.getElementById('profile-image-edit');

    const modal = document.getElementById('image-crop-modal');
    const cropSource = document.getElementById('image-crop-source');
    const closeButton = document.getElementById('image-crop-close');
    const cancelButton = document.getElementById('image-crop-cancel');
    const applyButton = document.getElementById('image-crop-apply');
    const zoomInButton = document.getElementById('image-crop-zoom-in');
    const zoomOutButton = document.getElementById('image-crop-zoom-out');
    const rotateButton = document.getElementById('image-crop-rotate');

    /*
     * หน้าอื่นที่ไม่มีช่องเลือกรูป
     * จะหยุดการทำงานตรงนี้โดยไม่เกิด error
     */
    if (
        !fileInput ||
        !preview ||
        !placeholder ||
        !modal ||
        !cropSource
    ) {
        return;
    }

    let cropper = null;
    let originalFile = null;
    let originalImageUrl = null;
    let croppedImageUrl = null;
    let hasAppliedCrop = false;

    const openModal = () => {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    };

    const closeModal = () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    };

    const destroyCropper = () => {
        if (!cropper) {
            return;
        }

        cropper.destroy();
        cropper = null;
    };

    const startCropper = (url) => {
        destroyCropper();

        cropSource.onload = () => {
            cropper = new Cropper(cropSource, {
                aspectRatio: 1,
                viewMode: 1,
                dragMode: 'move',
                autoCropArea: 1,
                responsive: true,
                restore: false,
                guides: true,
                center: true,
                highlight: false,
                background: false,
                movable: true,
                zoomable: true,
                rotatable: true,
                scalable: false,
                cropBoxMovable: true,
                cropBoxResizable: true,
                toggleDragModeOnDblclick: false,
            });
        };

        cropSource.src = url;
        openModal();
    };

    const resetNewFile = () => {
        fileInput.value = '';
        originalFile = null;

        if (fileName) {
            fileName.textContent = 'ยังไม่ได้เลือกไฟล์';
        }
    };

    fileInput.addEventListener('change', () => {
        const file = fileInput.files?.[0];

        if (!file) {
            return;
        }

        const acceptedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp',
        ];

        if (!acceptedTypes.includes(file.type)) {
            window.alert(
                'กรุณาเลือกไฟล์ JPG, PNG หรือ WEBP เท่านั้น'
            );

            resetNewFile();
            return;
        }

        if (file.size > 10 * 1024 * 1024) {
            window.alert(
                'รูปภาพต้องมีขนาดไม่เกิน 10 MB'
            );

            resetNewFile();
            return;
        }

        originalFile = file;
        hasAppliedCrop = false;

        if (originalImageUrl) {
            URL.revokeObjectURL(originalImageUrl);
        }

        originalImageUrl = URL.createObjectURL(file);

        if (fileName) {
            fileName.textContent = file.name;
        }

        startCropper(originalImageUrl);
    });

    applyButton?.addEventListener('click', () => {
        if (!cropper || !originalFile) {
            return;
        }

        const canvas = cropper.getCroppedCanvas({
            width: 1000,
            height: 1000,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',
        });

        if (!canvas) {
            window.alert('ไม่สามารถประมวลผลรูปภาพได้');
            return;
        }

        const outputType = originalFile.type === 'image/png'
            ? 'image/png'
            : originalFile.type === 'image/webp'
                ? 'image/webp'
                : 'image/jpeg';

        canvas.toBlob(
            (blob) => {
                if (!blob) {
                    window.alert(
                        'ไม่สามารถสร้างไฟล์รูปภาพได้'
                    );
                    return;
                }

                const extension = outputType === 'image/png'
                    ? 'png'
                    : outputType === 'image/webp'
                        ? 'webp'
                        : 'jpg';

                const croppedFile = new File(
                    [blob],
                    `profile-${Date.now()}.${extension}`,
                    {
                        type: outputType,
                        lastModified: Date.now(),
                    }
                );

                /*
                 * นำไฟล์ที่ Crop แล้วกลับเข้า input
                 * เพื่อให้ Laravel รับเป็น profile_image ตามเดิม
                 */
                const transfer = new DataTransfer();
                transfer.items.add(croppedFile);
                fileInput.files = transfer.files;

                if (croppedImageUrl) {
                    URL.revokeObjectURL(croppedImageUrl);
                }

                croppedImageUrl = URL.createObjectURL(
                    croppedFile
                );

                preview.src = croppedImageUrl;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');

                if (fileName) {
                    fileName.textContent =
                        `รูปที่ปรับแล้ว (${Math.ceil(
                            blob.size / 1024
                        )} KB)`;
                }

                editButton?.classList.remove('hidden');

                hasAppliedCrop = true;

                destroyCropper();
                closeModal();
            },
            outputType,
            0.9
        );
    });

    editButton?.addEventListener('click', () => {
        const url = croppedImageUrl || originalImageUrl;

        if (url) {
            startCropper(url);
        }
    });

    zoomInButton?.addEventListener('click', () => {
        cropper?.zoom(0.1);
    });

    zoomOutButton?.addEventListener('click', () => {
        cropper?.zoom(-0.1);
    });

    rotateButton?.addEventListener('click', () => {
        cropper?.rotate(90);
    });

    const cancelCrop = () => {
        destroyCropper();
        closeModal();

        /*
         * หากยังไม่เคยยืนยันการ Crop
         * ให้ยกเลิกไฟล์ใหม่ที่เพิ่งเลือก
         */
        if (!hasAppliedCrop) {
            resetNewFile();
        }
    };

    closeButton?.addEventListener('click', cancelCrop);
    cancelButton?.addEventListener('click', cancelCrop);

    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            cancelCrop();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (
            event.key === 'Escape' &&
            !modal.classList.contains('hidden')
        ) {
            cancelCrop();
        }
    });

    window.addEventListener('beforeunload', () => {
        if (originalImageUrl) {
            URL.revokeObjectURL(originalImageUrl);
        }

        if (croppedImageUrl) {
            URL.revokeObjectURL(croppedImageUrl);
        }
    });
});