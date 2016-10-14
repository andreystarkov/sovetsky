export const WP_URL = 'http://xn----7sbhjdshgxidscmfdhj.xn--p1ai';

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
  nav: WP_URL + '/wp-json/wp-api-menus/v2/menus/2',
  menu: WP_URL + '/wp-json/wp/v2/menuitems',
  media: WP_URL + '/wp-json/wp/v2/media/',
  mail: WP_URL + '/mail.php'
}

