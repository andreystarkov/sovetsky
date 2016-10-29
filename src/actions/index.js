import fetch from 'isomorphic-fetch'
import { WP_URL, api } from '../config'
import { pushStorage } from '../etc'

export const RECEIVE_PAGE = 'RECEIVE_PAGE';
export const RECEIVE_POSTS = 'RECEIVE_POSTS';
export const RECEIVE_MENUS = 'RECEIVE_MENUS';
export const RECEIVE_INTERIOR = 'RECEIVE_INTERIOR';
export const RECEIVE_INTERIOR_MAIN = 'RECEIVE_INTERIOR_MAIN';
export const RECEIVE_SLIDER_MAIN = 'RECEIVE_SLIDER_MAIN';
export const RECEIVE_SLIDER_INTERIOR = 'RECEIVE_SLIDER_INTERIOR';
export const RECEIVE_MENU_ITEMS = 'RECEIVE_MENU_ITEMS';
export const RECEIVE_GALLERY_ITEMS = 'RECEIVE_GALLERY_ITEMS';

const POSTS_PER_PAGE = 10;

function receivePage(pageName, pageData) {
    return {
        type: RECEIVE_PAGE,
        payload: {
            pageName: pageName,
            page: pageData
        }
    };
}

export function fetchPageIfNeeded(pageName) {
    return function(dispatch, getState) {
        if (shouldFetchPage(getState(), pageName)) {
            return fetch(WP_URL + '/wp/v2/pages?filter[name]=' + pageName)
                .then(response => response.json())
                .then(pages => dispatch(receivePage(pageName, pages[0])));
        }
    }
}

function shouldFetchPage(state, pageName) {
    const pages = state.pages;

    return !pages.hasOwnProperty(pageName);
}

export function fetchPosts(pageNum = 1) {
   // console.log('fetchPosts: called');
    return function (dispatch) {
        return fetch(WP_URL + '/wp/v2/posts?filter[paged]=' + pageNum + '&filter[posts_per_page]=' + POSTS_PER_PAGE)
            .then(response => Promise.all(
                [response.headers.get('X-WP-TotalPages'), response.json()]
            ))
            .then(postsData => dispatch(
                receivePosts(pageNum, postsData[0], postsData[1])
            ));
    }
}

function receiveMenus(menus){
  return {
    type: RECEIVE_MENUS,
    payload: {
      menus: menus
    }
  }
}

export function fetchMenus() {
  var stored = localStorage.getItem('nav');
  if ( stored ){
    var parsed = JSON.parse(stored);
    //console.log('fetchMenus: from localStorage: ', parsed);
    return (dispatch) => {
      return dispatch( receiveMenus(parsed) )
    }
  } else {
    return function (dispatch) {
        return fetch(api.nav)
            .then(response => Promise.all([response.json()]))
            .then(menusData => {
             // console.log('MENUS: ', menusData);
              if( menusData ) {
                pushStorage('nav', menusData);
                dispatch(receiveMenus(menusData));
              }
            });
    }
  }
}

function receiveInterior(interior){
  return {
    type: RECEIVE_INTERIOR,
    payload: {
      interior: interior
    }
  }
}

export function fetchInterior() {
 // console.log('fetchInterior');
    return function (dispatch) {
       // console.log('fetchInterior return');
        return fetch('http://localhost:3000/data/interiorImages.json')
            .then(response => Promise.all([response.json()]))
            .then(interiorData => dispatch(
                receiveInterior(interiorData)
            ));
    }
}

function receiveInteriorMain(interior){
  //console.log('receiveInteriorMain:' ,interior);
  return {
    type: RECEIVE_INTERIOR_MAIN,
    payload: {
      interiorMain: interior
    }
  }
}

/* fetch(api.media+obj.featured_media)
.then(response => response.json())
.then(data => {
  total.push({
    title: obj.title.rendered,
    text: obj.content.rendered,
    media: obj.featured_media,
    full: data.source_url,
    image: data.media_details
  });
  dispatch(receiveInteriorMain(total))
});*/

export function fetchInteriorMain() {

    return function (dispatch, getState) {

        return fetch(api.main.interior + '?per_page=100')
            .then(response => Promise.all([response.json()]))
            .then(interiorData => {

              const { counter } = getState();

              var list = interiorData[0], total = [];

              //console.log('fetchInteriorMain result: ', list);

              if( list ){

                list.map( (obj,key) => {
                    total.push({
                      title: obj.title.rendered,
                      text: obj.content.rendered,
                      media: obj.better_featured_image,
                      sizes: obj.better_featured_image.media_details.sizes,
                      full: obj.better_featured_image.source_url
                    });
                    dispatch(receiveInteriorMain(total))
                });

              }

            });
    }
}


function receivePosts(pageNum, totalPages, posts) {
    return {
        type: RECEIVE_POSTS,
        payload: {
            pageNum: pageNum,
            totalPages: totalPages,
            posts: posts
        }
    };
}



function receiveSliderMain(data){
 // console.log('receiveSliderMain:', data);
  return {
    type: RECEIVE_SLIDER_MAIN,
    payload: {
      main: data
    }
  }
}

export function fetchSliderMain() {

    return function (dispatch, getState) {

       // console.log('fetchSliderMain return ', api.main.slider);

        return fetch(api.main.slider + '?per_page=100')
            .then(response => Promise.all([response.json()]))
            .then(sliderData => {

             // const { counter } = getState();

              var list = sliderData[0], total = [];

            //  console.log('fetchSliderMain result: ', list);

              if( list ){

                list.map( (obj,key) => {
                    total.push({
                      title: obj.title.rendered,
                      text: obj.content.rendered,
                      media: obj.better_featured_image,
                      image: obj.better_featured_image,
                      sizes: obj.better_featured_image.media_details.sizes,
                      full: obj.better_featured_image.source_url
                    });
                    dispatch(receiveSliderMain(total))
                });

              }


            });
    }
}

function receiveSliderInterior(data){
  //console.log('receiveSliderInterior:', data);
  return {
    type: RECEIVE_SLIDER_INTERIOR,
    payload: {
      interior: data
    }
  }
}

export function fetchSliderInterior() {

    return function (dispatch, getState) {

       // console.log('fetchSliderMain return ', api.main.slider);

        return fetch(api.interior.slider + '?per_page=100')
            .then(response => Promise.all([response.json()]))
            .then(sliderData => {

             // const { counter } = getState();

              var list = sliderData[0], total = [];

             // console.log('fetchSliderInterior result: ', list);

              if( list ){

                list.map( (obj,key) => {
                    total.push({
                      title: obj.title.rendered,
                      text: obj.content.rendered,
                      media: obj.better_featured_image,
                      image: obj.better_featured_image,
                      sizes: obj.better_featured_image.media_details.sizes,
                      full: obj.better_featured_image.source_url
                    });
                    dispatch(receiveSliderInterior(total))
                });

              }


            });
    }
}



function receiveMenuItems(data){
 // console.log('receiveMenuItems:', data);
  return {
    type: RECEIVE_MENU_ITEMS,
    payload: {
      menu: data
    }
  }
}

export function fetchMenuItems() {

    return function (dispatch, getState) {

    //  console.log('fetchMenuItems return ', api.menu);

        return fetch(api.menu + '?per_page=100')
            .then(response => Promise.all([response.json()]))
            .then(menuData => {

           // console.log('fetchMenu: ', menuData);
              var list = menuData[0], total = [];

              if( list ){

                list.map( (obj,key) => {

                  fetch(api.acf.post + obj.id)
                    .then(response => response.json())
                    .then(acf => {
                     //console.log('fetchMenuItems ACF:' ,acf);

                      total.push({
                        title: obj.title.rendered,
                        description: acf.acf.description,
                        price: acf.acf.price,
                        weight: acf.acf.weight,
                        image: obj.better_featured_image,
                        sizes: obj.better_featured_image.media_details.sizes,
                        full: obj.better_featured_image.source_url
                      });
                      dispatch(receiveMenuItems(total))

                  });
                });
              }
            });
        }
}




function receiveGallery(data){
 // console.log('receiveSliderMain:', data);
  return {
    type: RECEIVE_GALLERY_ITEMS,
    payload: {
      gallery: data
    }
  }
}

export function fetchGallery() {
    return function (dispatch, getState) {

        // console.log('fetchSliderMain return ', api.gallery);

        return fetch(api.gallery + '?per_page=100')
            .then(response => Promise.all([response.json()]))
            .then(sliderData => {

             // const { counter } = getState();

              var list = sliderData[0], total = [];

              //    +console.log('fetchGallery result: ', list);

              if( list ){

                list.map( (obj,key) => {
                    total.push({
                      title: obj.title.rendered,
                      text: obj.content.rendered,
                      media: obj.better_featured_image,
                      image: obj.better_featured_image,
                      full: obj.better_featured_image.source_url
                    });
                    dispatch(receiveGallery(total))
                });

              }


            });
    }
}
