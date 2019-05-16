// const fs = require("fs");
// const json = fs.readFileSync("dummy.json");

let arr = [];

arr.push(
    '{"id":"1","name":"Empresas Polar","websiteUrl":"http://empresaspolar.com/","imageUrl":"http://empresaspolar.com/img/app/header-logo-empresas-polar.png","description":"Empresas Polar es una corporaci\u00f3n industrial venezolana cuyas actividades productivas abarcan los sectores de alimentos, bebidas alcoh\u00f3licas, gaseosas y productos de consumo masivo bajo sus filiales Alimentos Polar, Cervecer\u00eda Polar, y Pepsi-Cola Venezuela, formando as\u00ed parte de la vida diaria de cada venezolano proporcionando productos de excelente calidad para cada ocasi\u00f3n.","visible":"1"}'
);

arr.push(
    '{"id":"2","name":"Banesco","websiteUrl":"http://www.banesco.com/","imageUrl":"http://banesco.blob.core.windows.net/banesco-prod-2015/wp-content/uploads/logo.png","description":"Banesco Banco Universal C.A. es una instituci\u00f3n financiera de capital venezolano.","visible":"1"}'
);

arr.push(
    '{"id":"3","name":"The Hoppy Hog","websiteUrl":"https://www.facebook.com/thehoppyhogpanama/?ref=nf","imageUrl":"https://scontent-mia3-2.cdninstagram.com/vp/38832ee9fa05afcaaa21d327e9afd1a3/5C2FF10B/t51.2885-19/s150x150/13827423_1125262830845810_1322297483_a.jpg","description":"","visible":"1"}'
);

arr.push(
    '{"id":"4","name":"Taberna 21","websiteUrl":"http://www.taberna21.com/","imageUrl":"http://www.taberna21.com/wp-content/uploads/2017/08/cropped-Logo-text.png","description":"La Taberna 21 es un restaurante ubicado en Panam\u00e1, con un men\u00fa de platillos procedentes de Espa\u00f1a.","visible":"1"}'
);

arr.push(
    '{"id":"5","name":"Industria Loncheria","websiteUrl":"https://www.facebook.com/industriapanama/","imageUrl":"","description":"Restaurante de comida saludable ubicado el la ciudad de Panam\u00e1.\r\nUn restaurante \u00fanico, industrial y elegante con la mezcla exacta de vegetaci\u00f3n, hierro y madera que nos brinda una atm\u00f3sfera c\u00e1lida para compartir a la hora de comer y disfrutar entre amigos y familiares.","visible":"1"}'
);

arr.push(
    '{"id":"6","name":"Banco Provincial","websiteUrl":"https://www.provincial.com/","imageUrl":"https://www.provincial.com/fbin/mult/logo-bbva-provincial_tcm1305-457234.png","description":"BBVA Provincial es una instituci\u00f3n financiera venezolana con sede en Caracas que es controlada por el grupo espa\u00f1ol BBVA.","visible":"1"}'
);

arr.push(
    '{"id":"7","name":"Slabon","websiteUrl":"https://slabonpanama.com/","imageUrl":"https://slabonpanama.com/wp-content/uploads/2015/09/logo-slabon-300x203.png","description":"La reconocida cadena de hamburguesas paname\u00f1a Slab\u00f3n Caf\u00e9 & Bistr\u00f3 confi\u00f3 en nosotros el dise\u00f1o y ejecuci\u00f3n de su nueva sucursal en la nueva feria de alimentos del popular centro comercial Multiplaza Panam\u00e1. \r\n\r\n\r\nUn dise\u00f1o que renueva la imagen de la marca manteniendo sus elementos distintivos y un presupuesto accesible donde el centro de atenci\u00f3n es el bar y la barra en esquina animando al p\u00fablico a disfrutar del ambiente del restaurante por mayor tiempo.","visible":"1"}'
);

// console.log(arr[5]);

arr.forEach((cliente, index) => {
    try {
        JSON.parse(cliente);
        console.log(`${index + 1} esta bien`);
    } catch (err) {
        console.log("ERROR EN: ", index + 1);
        console.log(err);
    }
});

// arr.forEach(cliente => {
//     console.log('parsed', JSON.parse(cliente))
//     console.log('=======================')
// })
