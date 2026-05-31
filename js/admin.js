// Admin Panel JavaScript
document.addEventListener('DOMContentLoaded', function() {
    
    // ==================== Toast Notification System ====================
    function showToast(title, message, type = 'success') {
        const toastContainer = document.getElementById('toast-container') || createToastContainer();
        
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        
        let icon = '✓';
        if (type === 'error') icon = '✗';
        if (type === 'warning') icon = '⚠';
        
        toast.innerHTML = `
            <div class="toast-icon">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-times-circle' : 'fa-exclamation-triangle'}"></i>
            </div>
            <div class="toast-content">
                <div class="toast-title">${title}</div>
                <div class="toast-message">${message}</div>
            </div>
            <button class="toast-close">&times;</button>
        `;
        
        toastContainer.appendChild(toast);
        
        // Add close functionality
        const closeBtn = toast.querySelector('.toast-close');
        closeBtn.addEventListener('click', () => {
            toast.remove();
        });
        
        // Auto remove after 4 seconds
        setTimeout(() => {
            if (toast.parentNode) {
                toast.style.animation = 'slideInRight 0.3s reverse';
                setTimeout(() => toast.remove(), 300);
            }
        }, 4000);
    }
    
    function createToastContainer() {
        const container = document.createElement('div');
        container.id = 'toast-container';
        container.className = 'toast-notification';
        document.body.appendChild(container);
        return container;
    }
    
    // ==================== Confirmation Modal ====================
    function showConfirmModal(options) {
        return new Promise((resolve) => {
            const overlay = document.createElement('div');
            overlay.className = 'modal-overlay';
            
            const modal = document.createElement('div');
            modal.className = 'confirm-modal';
            
            modal.innerHTML = `
                <div class="modal-header">
                    <i class="fas ${options.icon || 'fa-trash-alt'}"></i>
                    <h3>${options.title || 'Confirm Action'}</h3>
                </div>
                <div class="modal-body">
                    <p>${options.message || 'Are you sure you want to proceed?'}</p>
                    ${options.imageName ? `<div class="image-name">"${escapeHtml(options.imageName)}"</div>` : ''}
                </div>
                <div class="modal-footer">
                    <button class="modal-cancel">Cancel</button>
                    <button class="modal-confirm">${options.confirmText || 'Confirm'}</button>
                </div>
            `;
            
            overlay.appendChild(modal);
            document.body.appendChild(overlay);
            
            const cancelBtn = modal.querySelector('.modal-cancel');
            const confirmBtn = modal.querySelector('.modal-confirm');
            
            cancelBtn.addEventListener('click', () => {
                overlay.remove();
                resolve(false);
            });
            
            confirmBtn.addEventListener('click', () => {
                overlay.remove();
                resolve(true);
            });
            
            // Close on overlay click
            overlay.addEventListener('click', (e) => {
                if (e.target === overlay) {
                    overlay.remove();
                    resolve(false);
                }
            });
        });
    }
    
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    // ==================== LOADER A: Dashboard Loader ====================
    const dashboardLoader = document.getElementById('dashboard-loader');
    const dashboardContent = document.getElementById('dashboard-content');
    
    if (dashboardLoader && dashboardContent) {
        setTimeout(function() {
            dashboardLoader.style.opacity = '0';
            setTimeout(function() {
                dashboardLoader.style.display = 'none';
                dashboardContent.style.display = 'block';
                dashboardContent.style.animation = 'fadeIn 0.5s ease-in';
                showToast('Welcome', 'Dashboard loaded successfully', 'success');
            }, 300);
        }, 800);
    }
    
    // ==================== Image Preview Feature ====================
    const imageInput = document.querySelector('input[name="image"]');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const imagePreview = document.getElementById('imagePreview');
    const clearPreviewBtn = document.getElementById('clearPreview');
    
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image-webp'];
                if (!allowedTypes.includes(file.type)) {
                    showToast('Invalid File', 'Only JPG, PNG, GIF, and WEBP images are allowed', 'error');
                    imageInput.value = '';
                    imagePreviewContainer.style.display = 'none';
                    return false;
                }
                
                if (file.size > 5 * 1024 * 1024) {
                    showToast('File Too Large', 'Image size should be less than 5MB', 'error');
                    imageInput.value = '';
                    imagePreviewContainer.style.display = 'none';
                    return false;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreviewContainer.style.display = 'block';
                    imagePreviewContainer.style.animation = 'slideIn 0.3s ease-out';
                };
                reader.readAsDataURL(file);
            } else {
                imagePreviewContainer.style.display = 'none';
            }
        });
    }
    
    if (clearPreviewBtn) {
        clearPreviewBtn.addEventListener('click', function() {
            imageInput.value = '';
            imagePreviewContainer.style.display = 'none';
            imagePreview.src = '';
        });
    }
    
    // ==================== Upload Loader ====================
    const addImageForm = document.getElementById('addImageForm');
    const uploadBtn = document.getElementById('uploadBtn');
    const uploadLoader = document.getElementById('uploadLoader');
    
    if (addImageForm) {
        addImageForm.addEventListener('submit', function(e) {
            const caption = this.querySelector('input[name="caption"]').value;
            const imageFile = this.querySelector('input[name="image"]').files[0];
            
            if (!caption.trim()) {
                e.preventDefault();
                showToast('Missing Caption', 'Please enter a caption for the image', 'warning');
                return false;
            }
            
            if (!imageFile) {
                e.preventDefault();
                showToast('No Image Selected', 'Please select an image file', 'warning');
                return false;
            }
            
            if (uploadBtn && uploadLoader) {
                uploadBtn.style.display = 'none';
                uploadLoader.style.display = 'flex';
            }
            
            // Show uploading toast
            showToast('Uploading', 'Your image is being uploaded...', 'warning');
        });
    }
    
    // ==================== Enhanced Delete with Professional Modal ====================
    const deleteButtons = document.querySelectorAll('.btn-delete');
    
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', async function(e) {
            e.preventDefault();
            
            // Get the image card and find the caption
            const imageCard = this.closest('.image-card');
            const captionInput = imageCard.querySelector('.edit-form input[name="caption"]');
            const imageCaption = captionInput ? captionInput.value : 'this image';
            const deleteUrl = this.getAttribute('href');
            
            // Show professional confirmation modal
            const confirmed = await showConfirmModal({
                title: 'Delete Image',
                message: 'Are you sure you want to delete this image?',
                imageName: imageCaption,
                icon: 'fa-trash-alt',
                confirmText: 'Delete Permanently'
            });
            
            if (confirmed) {
                // Show deleting toast
                showToast('Deleting', `Removing "${imageCaption}"...`, 'warning');
                
                // Add loading state to button
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
                this.style.opacity = '0.7';
                
                // Follow the delete link
                window.location.href = deleteUrl;
            }
        });
    });
    
    // ==================== Enhanced Update with Professional Toast ====================
    const editForms = document.querySelectorAll('.edit-form');
    
    editForms.forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const imageCard = this.closest('.image-card');
            const captionInput = this.querySelector('input[name="caption"]');
            const categorySelect = this.querySelector('select[name="category"]');
            const pageSelect = this.querySelector('select[name="page"]');
            const updateBtn = this.querySelector('.btn-edit');
            
            const oldCaption = captionInput.defaultValue;
            const newCaption = captionInput.value;
            
            // Show confirmation for update
            const confirmed = await showConfirmModal({
                title: 'Update Image',
                message: `Are you sure you want to update this image?`,
                imageName: newCaption,
                icon: 'fa-edit',
                confirmText: 'Update'
            });
            
            if (confirmed) {
                // Show updating toast
                showToast('Updating', `Updating image information...`, 'warning');
                
                // Add loading state
                const originalText = updateBtn.innerHTML;
                updateBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
                updateBtn.disabled = true;
                
                // Create form data
                const formData = new FormData();
                formData.append('edit_image', '1');
                formData.append('image_id', this.querySelector('input[name="image_id"]').value);
                formData.append('caption', newCaption);
                formData.append('category', categorySelect.value);
                formData.append('page', pageSelect.value);
                
                // Submit via fetch for better UX
                try {
                    const response = await fetch(window.location.href, {
                        method: 'POST',
                        body: formData
                    });
                    
                    const text = await response.text();
                    
                    if (text.includes('alert-success') || response.ok) {
                        showToast('Success!', `Image "${newCaption}" has been updated`, 'success');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        showToast('Update Failed', 'There was an error updating the image', 'error');
                        updateBtn.innerHTML = originalText;
                        updateBtn.disabled = false;
                    }
                } catch (error) {
                    showToast('Error', 'Network error occurred', 'error');
                    updateBtn.innerHTML = originalText;
                    updateBtn.disabled = false;
                }
            }
        });
    });
    
    // ==================== Check for success/error messages from PHP ====================
    const successAlert = document.querySelector('.alert-success');
    const errorAlert = document.querySelector('.alert-error');
    
    if (successAlert) {
        const message = successAlert.textContent.trim();
        showToast('Success', message, 'success');
        setTimeout(() => {
            successAlert.style.display = 'none';
        }, 500);
    }
    
    if (errorAlert) {
        const message = errorAlert.textContent.trim();
        showToast('Error', message, 'error');
        setTimeout(() => {
            errorAlert.style.display = 'none';
        }, 500);
    }
    
    // ==================== Hide loader on page load ====================
    window.addEventListener('pageshow', function() {
        if (uploadBtn && uploadLoader) {
            uploadBtn.style.display = 'flex';
            uploadLoader.style.display = 'none';
        }
    });
    
    // ==================== Mobile Improvements ====================
    const imageCards = document.querySelectorAll('.image-card');
    imageCards.forEach(card => {
        card.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.98)';
        });
        card.addEventListener('touchend', function() {
            this.style.transform = 'translateY(-5px)';
        });
    });
});