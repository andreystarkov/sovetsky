export const WP_URL = 'http://xn----7sbhjdshgxidscmfdhj.xn--p1ai/wp';

export const api = {
  main: {
    slider: WP_URL + '/wp-json/wp/v2/slidermain',
    interior: WP_URL + '/wp-json/wp/v2/interiormain'
  },
  interior: {
  	slider: WP_URL + '/wp-json/wp/v2/interiorslider',
  	gallery: WP_URL + '/wp-json/wp/v2/interior'
  },
  acf: {
    post: WP_URL + '/wp-json/acf/v2/post/'
  },
  gallery: WP_URL + '/wp-json/wp/v2/photogallery',
  nav: WP_URL + '/wp-json/wp-api-menus/v2/menus/2',
  menu: WP_URL + '/wp-json/wp/v2/menuitems',
  media: WP_URL + '/wp-json/wp/v2/media/',
  mail: 'http://xn----7sbhjdshgxidscmfdhj.xn--p1ai/mail.php'
}

export const swalSettings = {
    confirmButtonText: 'Продолжить',
    cancelButtonText: 'Отменить',
    padding: '50',
    buttonsStyling: false,
    customClass: 'modal-confirm'
}
