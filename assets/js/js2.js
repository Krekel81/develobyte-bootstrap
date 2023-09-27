"use strict";
document.addEventListener('DOMContentLoaded', run);

function run()
{
    sendBack();
}

async function sendBack() {
    let html = '';
    for (let i = 5; i >= 0; i--) {
        html = `U wordt teruggestuurd naar de site binnen ${i} seconden...`;
        if(i == 1)
        {
            html = `U wordt teruggestuurd naar de site binnen ${i} seconde...`;
        }
        document.querySelector('main p.seconden').innerHTML = html;
        await sleep(1400);
    }
    location.href = "index.html#contact";
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}
