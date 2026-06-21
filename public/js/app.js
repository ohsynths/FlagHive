function togglePass(btn) {
    const input = btn.parentElement.querySelector('input');
    const isPass = input.type === 'password';
    input.type = isPass ? 'text' : 'password';
    btn.textContent = isPass ? '[hide]' : '[show]';
}
