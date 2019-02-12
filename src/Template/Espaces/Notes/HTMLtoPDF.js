const puppeteer = require('puppeteer');
const fs = require('fs-extra');

(async function () {
    try {
        console.log('done');
        const browser = await puppeteer.lunch();
        const page = await browser.newPage();

        await page.setContent('<h1>Anass</h1>');
        await page.emulateMedia('screen');
        await page.pdf({
            path: 'Notes.pdf',
            format: 'A4',
            printBackground: true
        });

        console.log('done');
        await browser.close();
        process.exit();

    } catch (e) {
        console.log('Out error : ', e);
    }
})