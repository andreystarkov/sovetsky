export const WP_URL = 'http://archive.andreystarkov.ru/wp-json';

export const api = {
  main: {
    slider: WP_URL + '/wp/v2/slidermain',
    interior: WP_URL + '/wp/v2/interiormain'
  },
  interior: {
  	slider: WP_URL + '/wp/v2/interiorslider',
  	gallery: WP_URL + '/wp/v2/interior'
  },
  media: WP_URL + '/wp/v2/media/'
}
