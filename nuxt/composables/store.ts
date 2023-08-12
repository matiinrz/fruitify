import * as moment_en from "moment";
import * as moment_fa from "moment-jalaali";
import * as  moment from 'moment-jalaali'


// export const getUserShow = auth

export function getUserShow() {
    const auth = useAuth();
    return auth
}


export function imageUrl(image: string) {
    const config = useRuntimeConfig();

    const baseUrl = config.public.imageUrl
    return baseUrl + image
}


export function current(time: string) {
    let today = new Date();
    let year = today.getFullYear();
    let month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based, so we add 1
    let day = String(today.getDate()).padStart(2, '0');
    let h = String(today.getHours()).padStart(2, '0');
    let m = String(today.getMinutes()).padStart(2, '0');
    let s = String(today.getSeconds()).padStart(2, '0');
    if (time) {
        let formattedDate = year + '-' + month + '-' + day + ' ' + h + ':' + m + ':' + s;
        return formattedDate;
    }
    else {
        let formattedDate = year + '-' + month + '-' + day;
        return formattedDate;
    }


    // Get the year, month, and day from the Date object


    // Combine the year, month, and day in the desired format

}

export function getMonth() {
    moment_fa.loadPersian();
    const date = current()
    return moment_fa.utc(date).locale('fa').local().format('jM')
}


export function money(input: any) {
    try {
        return input.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    } catch (e) {
        return input;
    }
}

export function datetime(input: string, format?: string, def?: string) {
    try {
        if (input == null || input.length <= 0) return def;

        if (format == null) format = 'jYYYY/jMM/jDD';
        moment_fa.loadPersian();
        return moment_fa.utc(input).format(format);

    } catch (e) {
        return def;
    }
}

function jalalian(input: any) {
    try {
        let moment = require('moment-jalaali');
        let date = moment(input, 'jYYYY/jMM/jDD HH:mm:ss.SSS');
        return date.format('jYYYY/jM/jD');
    } catch (e) {
        return input;
    }
}
const { $event } = useNuxtApp()

export function showImageDialog(image: string) {
    console.log('image :', image);

    $event('image-dialog', image)
}

export function getPermission(permission: string) {
    switch (permission) {
        case 'user': return 'اپراتور'
        case 'superuser': return 'ادمین'
    }
}

export function getTime(input: string) {
    try {
        let time = input.split(" ")[1].split(":");
        return time[0] + ":" + time[1];
    } catch (e) {
        return input;
    }
}

export function fa(input: any) {
    try {
        if (input === undefined) return '';
        let str1 = input.toString().trim();
        if (str1 === '') return '';
        str1 = str1.replace(/0/img, '۰');
        str1 = str1.replace(/1/img, '۱');
        str1 = str1.replace(/2/img, '۲');
        str1 = str1.replace(/3/img, '۳');
        str1 = str1.replace(/4/img, '۴');
        str1 = str1.replace(/5/img, '۵');
        str1 = str1.replace(/6/img, '۶');
        str1 = str1.replace(/7/img, '۷');
        str1 = str1.replace(/8/img, '۸');
        str1 = str1.replace(/9/img, '۹');
        return str1;
    } catch (e) {
        return input;
    }
}

export function en(input: any) {
    if (input === undefined) return "";
    let str1 = input.toString().trim();
    if (str1 === "") return "";
    str1 = str1.replace(/۰/gim, "0");
    str1 = str1.replace(/۱/gim, "1");
    str1 = str1.replace(/۲/gim, "2");
    str1 = str1.replace(/۳/gim, "3");
    str1 = str1.replace(/۴/gim, "4");
    str1 = str1.replace(/۵/gim, "5");
    str1 = str1.replace(/۶/gim, "6");
    str1 = str1.replace(/۷/gim, "7");
    str1 = str1.replace(/۸/gim, "8");
    str1 = str1.replace(/۹/gim, "9");
    return str1;
}