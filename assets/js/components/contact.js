/**
 * Contact Form Interactive Functionality
 *
 * Handles validation and AJAX form submission with immediate UI feedback
 *
 * @package Drive
 */

(function() {
    'use strict';

    function initContactForm() {
        var form = document.getElementById('driveContactForm');
        if (!form) return;

        var nameInput    = document.getElementById('contact_name');
        var emailInput   = document.getElementById('contact_email');
        var messageInput = document.getElementById('contact_message');
        var submitBtn    = document.getElementById('contactSubmitBtn');
        var noticeBox    = document.getElementById('contactFormNotice');

        var nameError    = document.getElementById('name_error');
        var emailError   = document.getElementById('email_error');
        var messageError = document.getElementById('message_error');

        function validateEmail(email) {
            var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        function clearErrors() {
            [nameInput, emailInput, messageInput].forEach(function(input) {
                if (input) input.classList.remove('is-invalid');
            });
            [nameError, emailError, messageError].forEach(function(err) {
                if (err) {
                    err.textContent = '';
                    err.classList.remove('is-visible');
                }
            });
            if (noticeBox) {
                noticeBox.style.display = 'none';
                noticeBox.className = 'contact-form-notice';
                noticeBox.textContent = '';
            }
        }

        // Live error clearing on input
        if (nameInput) {
            nameInput.addEventListener('input', function() {
                nameInput.classList.remove('is-invalid');
                if (nameError) nameError.classList.remove('is-visible');
            });
        }
        if (emailInput) {
            emailInput.addEventListener('input', function() {
                emailInput.classList.remove('is-invalid');
                if (emailError) emailError.classList.remove('is-visible');
            });
        }
        if (messageInput) {
            messageInput.addEventListener('input', function() {
                messageInput.classList.remove('is-invalid');
                if (messageError) messageError.classList.remove('is-visible');
            });
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            clearErrors();

            var isValid = true;

            // Name check
            var nameVal = (nameInput.value || '').trim();
            if (!nameVal) {
                isValid = false;
                nameInput.classList.add('is-invalid');
                if (nameError) {
                    nameError.textContent = 'Please enter your name.';
                    nameError.classList.add('is-visible');
                }
            }

            // Email check
            var emailVal = (emailInput.value || '').trim();
            if (!emailVal || !validateEmail(emailVal)) {
                isValid = false;
                emailInput.classList.add('is-invalid');
                if (emailError) {
                    emailError.textContent = 'Please enter a valid email address.';
                    emailError.classList.add('is-visible');
                }
            }

            // Message check
            var msgVal = (messageInput.value || '').trim();
            if (!msgVal) {
                isValid = false;
                messageInput.classList.add('is-invalid');
                if (messageError) {
                    messageError.textContent = 'Please enter your message.';
                    messageError.classList.add('is-visible');
                }
            }

            if (!isValid) return;

            // Loading state
            submitBtn.classList.add('is-loading');
            submitBtn.disabled = true;

            var formData = new FormData(form);

            var ajaxUrl = (typeof driveContactData !== 'undefined' && driveContactData.ajaxUrl) 
                ? driveContactData.ajaxUrl 
                : '/wp-admin/admin-ajax.php';

            fetch(ajaxUrl, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            })
            .then(function(res) {
                return res.json();
            })
            .then(function(data) {
                submitBtn.classList.remove('is-loading');
                submitBtn.disabled = false;

                if (data && data.success) {
                    form.reset();
                    if (noticeBox) {
                        noticeBox.className = 'contact-form-notice is-success';
                        noticeBox.textContent = data.data && data.data.message ? data.data.message : 'Thank you! Your message has been sent.';
                        noticeBox.style.display = 'block';
                    }
                } else {
                    if (noticeBox) {
                        noticeBox.className = 'contact-form-notice is-error';
                        noticeBox.textContent = data && data.data && data.data.message ? data.data.message : 'An error occurred. Please try again.';
                        noticeBox.style.display = 'block';
                    }
                }
            })
            .catch(function(err) {
                submitBtn.classList.remove('is-loading');
                submitBtn.disabled = false;
                if (noticeBox) {
                    noticeBox.className = 'contact-form-notice is-error';
                    noticeBox.textContent = 'Unable to send message right now. Please email us directly or try again later.';
                    noticeBox.style.display = 'block';
                }
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initContactForm);
    } else {
        initContactForm();
    }
})();

