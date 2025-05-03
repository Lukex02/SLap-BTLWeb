// Simple JS để hiển thị năm hiện tại tự động
document.addEventListener('DOMContentLoaded', function() {
    const footer = document.querySelector('#footer p');
    const currentYear = new Date().getFullYear();
    footer.innerHTML = `&copy; ${currentYear} MyWebsite. All rights reserved.`;
});
