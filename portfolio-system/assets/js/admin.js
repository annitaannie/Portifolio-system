// Admin Panel JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Confirm delete actions
    const deleteButtons = document.querySelectorAll('.btn-delete, .delete-btn');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
                e.preventDefault();
                return false;
            }
        });
    });
    
    // Preview image before upload
    const imageInputs = document.querySelectorAll('input[type="file"][accept*="image"]');
    
    imageInputs.forEach(input => {
        input.addEventListener('change', function(e) {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                const previewContainer = this.parentElement.querySelector('.image-preview');
                
                reader.onload = function(e) {
                    if (previewContainer) {
                        previewContainer.innerHTML = `<img src="${e.target.result}" alt="Preview" style="max-width: 200px; margin-top: 10px;">`;
                    } else {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '200px';
                        img.style.marginTop = '10px';
                        this.parentElement.appendChild(img);
                    }
                }.bind(this);
                
                reader.readAsDataURL(file);
            }
        });
    });
    
    // Message view modal
    const viewMessageBtns = document.querySelectorAll('.view-message');
    const modal = document.getElementById('messageModal');
    
    if (viewMessageBtns.length > 0 && modal) {
        viewMessageBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const messageId = this.getAttribute('data-id');
                const messageName = this.getAttribute('data-name');
                const messageEmail = this.getAttribute('data-email');
                const messageSubject = this.getAttribute('data-subject');
                const messageContent = this.getAttribute('data-message');
                
                document.getElementById('modalName').textContent = messageName;
                document.getElementById('modalEmail').textContent = messageEmail;
                document.getElementById('modalSubject').textContent = messageSubject || 'No subject';
                document.getElementById('modalMessage').textContent = messageContent;
                
                modal.classList.add('show');
                
                // Mark as read via AJAX
                fetch('ajax-mark-read.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + messageId
                });
            });
        });
        
        // Close modal
        const closeModal = document.querySelector('.modal-close');
        if (closeModal) {
            closeModal.addEventListener('click', function() {
                modal.classList.remove('show');
            });
        }
        
        window.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('show');
            }
        });
    }
    
    // Skills management - Add new skill row
    const addSkillBtn = document.getElementById('addSkillBtn');
    const skillsTable = document.getElementById('skillsTable');
    
    if (addSkillBtn && skillsTable) {
        addSkillBtn.addEventListener('click', function() {
            const tbody = skillsTable.querySelector('tbody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><input type="text" name="skill_name[]" required></td>
                <td><input type="number" name="proficiency[]" min="0" max="100" required></td>
                <td>
                    <select name="category[]">
                        <option value="Technical">Technical</option>
                        <option value="Frontend">Frontend</option>
                        <option value="Backend">Backend</option>
                        <option value="Database">Database</option>
                        <option value="Tools">Tools</option>
                        <option value="Framework">Framework</option>
                    </select>
                </td>
                <td><input type="number" name="display_order[]" value="0"></td>
                <td>
                    <button type="button" class="btn-delete remove-row">Remove</button>
                </td>
            `;
            tbody.appendChild(newRow);
            
            // Add remove functionality to new row
            const removeBtn = newRow.querySelector('.remove-row');
            removeBtn.addEventListener('click', function() {
                newRow.remove();
            });
        });
    }
    
    // Remove skill rows
    document.querySelectorAll('.remove-row').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('tr').remove();
        });
    });
    
    // Dashboard charts (if Chart.js is available)
    if (typeof Chart !== 'undefined') {
        const skillsChart = document.getElementById('skillsChart');
        if (skillsChart) {
            // Fetch skills data via AJAX
            fetch('ajax-skills-data.php')
                .then(response => response.json())
                .then(data => {
                    new Chart(skillsChart, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Proficiency %',
                                data: data.values,
                                backgroundColor: 'rgba(37, 99, 235, 0.5)',
                                borderColor: 'rgba(37, 99, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: 100
                                }
                            },
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });
                });
        }
    }
    
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 300);
        }, 5000);
    });
    
    // Form validation for admin forms
    const adminForms = document.querySelectorAll('.admin-form');
    adminForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = '#ef4444';
                    
                    // Remove error style after 3 seconds
                    setTimeout(() => {
                        field.style.borderColor = '';
                    }, 3000);
                } else {
                    field.style.borderColor = '';
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                showAdminAlert('Please fill in all required fields.', 'error');
            }
        });
    });
    