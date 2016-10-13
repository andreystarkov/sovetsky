import fetch from 'isomorphic-fetch'
import { WP_URL, api } from '../config'

export const RECEIVE_PAGE = 'RECEIVE_PAGE';
export const RECEIVE_POSTS = 'RECEIVE_POSTS';
export const RECEIVE_MENUS = 'RECEIVE_MENUS';
export const RECEIVE_INTERIOR = 'RECEIVE_INTERIOR';
export const RECEIVE_INTERIOR_MAIN = 'RECEIVE_INTERIOR_MAIN';
export const RECEIVE_SLIDER_MAIN = 'RECEIVE_SLIDER_MAIN';
export const RECEIVE_SLIDER_INTERIOR = 'RECEIVE_SLIDER_INTERIOR';

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
    return function (dispatch) {
        return fetch(WP_URL + '/wp-api-menus/v2/menus/2')
            .then(response => Promise.all([response.json()]))
            .then(menusData => dispatch(
                receiveMenus(menusData)
            ));
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
        console.log('fetchInterior return');
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

export function fetchInteriorMain() {

    return function (dispatch, getState) {

        //console.log('fetchInteriorMain return ',api.main.interior);

        return fetch(api.main.interior)
            .then(response => Promise.all([response.json()]))
            .then(interiorData => {

              const { counter } = getState();

              var list = interiorData[0], total = [];

              //console.log('fetchInteriorMain result: ', list);

              if( list ){

                list.map( (obj,key) => {

                  fetch(api.media+obj.featured_media)
                      .then(response => response.json())
                      .then(data => {
                     //   console.log('InteriorMain media:' ,data);
                        total.push({
                          title: obj.title.rendered,
                          text: obj.content.rendered,
                          media: obj.featured_media,
                          full: data.source_url,
                          image: data.media_details
                        });
                        dispatch(receiveInteriorMain(total))
                      });

                });

              //  console.log('InteriorMain total: ', total, 'counter: ', counter);

                if( total ) {
                  //dispatch(receiveInteriorMain(total));
                  setTimeout( () => {
                    console.log('Timeout: ', total, counter);
                   // dispatch(receiveInteriorMain(total));
                  }, 1500);
                }

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

        return fetch(api.main.slider)
            .then(response => Promise.all([response.json()]))
            .then(sliderData => {

             // const { counter } = getState();

              var list = sliderData[0], total = [];

            //  console.log('fetchSliderMain result: ', list);

              if( list ){

                list.map( (obj,key) => {

                  fetch(api.media+obj.featured_media)
                      .then(response => response.json())
                      .then(data => {
                       // console.log('sliderMain media:' ,data);
                        total.push({
                          title: obj.title.rendered,
                          text: obj.content.rendered,
                          media: obj.featured_media,
                          full: data.source_url,
                          image: data.media_details
                        });
                         dispatch(receiveSliderMain(total))
                      });

                });

               // console.log('SliderMain total: ', total);

                if( total ) {
                  //dispatch(receiveSliderMain(total));
                  setTimeout( () => {
                   // console.log('SliderMain Timeout: ', total);
                  }, 1500);
                }

              }

            });
    }
}

function receiveSliderInterior(data){
  console.log('receiveSliderInterior:', data);
  return {
    type: RECEIVE_SLIDER_INTERIOR,
    payload: {
      interior: data
    }
  }
}

export function fetchSliderInterior() {

    return function (dispatch, getState) {

        console.log('fetchSliderMain return ', api.main.slider);

        return fetch(api.interior.slider)
            .then(response => Promise.all([response.json()]))
            .then(sliderData => {

             // const { counter } = getState();

              var list = sliderData[0], total = [];

              console.log('fetchSliderInterior result: ', list);

              if( list ){

                list.map( (obj,key) => {

                  fetch(api.media+obj.featured_media)
                      .then(response => response.json())
                      .then(data => {
                        console.log('sliderInterior media:' ,data);
                        total.push({
                          title: obj.title.rendered,
                          text: obj.content.rendered,
                          media: obj.featured_media,
                          full: data.source_url,
                          image: data.media_details
                        });
                         dispatch(receiveSliderInterior(total))
                      });

                });

                console.log('SliderInterior total: ', total);

                if( total ) {
                  //dispatch(receiveSliderMain(total));
                  setTimeout( () => {
                   // console.log('SliderMain Timeout: ', total);
                  }, 1500);
                }

              }

            });
    }
}
