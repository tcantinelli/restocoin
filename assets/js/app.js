// loads the jquery package from node_modules
const $ = require('jquery');

//require all images
const imagesContext = require.context('../img', true, /\.(png|jpg|jpeg|gif|ico|svg|webp)$/);

imagesContext.keys().forEach(imagesContext);