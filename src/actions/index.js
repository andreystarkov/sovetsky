import fetch from 'isomorphic-fetch';
import { WP_URL } from '../wp-url';

export const RECEIVE_PAGE = 'RECEIVE_PAGE';
export const RECEIVE_POSTS = 'RECEIVE_POSTS';
export const RECEIVE_MENUS = 'RECEIVE_MENUS';
export const RECEIVE_INTERIOR = 'RECEIVE_INTERIOR';

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
            return fetch(WP_URL + '/pages?filter[name]=' + pageName)
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
    return function (dispatch) {
        return fetch(WP_URL + '/posts?filter[paged]=' + pageNum + '&filter[posts_per_page]=' + POSTS_PER_PAGE)
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
  console.log('fetchMenus');
    return function (dispatch) {
        console.log('dfsds');
        return fetch('http://sv.dev:666/wp-json/wp-api-menus/v2/menus/2')
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
  console.log('fetchInterior');
    return function (dispatch) {
        console.log('fetchInterior return');
        return fetch('http://localhost:3000/data/interiorImages.json')
            .then(response => Promise.all([response.json()]))
            .then(interiorData => dispatch(
                receiveInterior(interiorData)
            ));
    }
}

/*
export function fetchMenus() {
    return function (dispatch) {
        return fetch('http://sv.dev:666/wp-json/wp-api-menus/v2/menus/2')
            .then(response => response.json())
            .then(menusData => dispatch(
                receiveMenus(menusData)
            ));
    }
}
export function fetchMenus() {
  return dispatch => {
    return fetch('http://sv.dev:666/wp-json/wp-api-menus/v2/menus/2')
      .then(response => response.json())
      .then(json => dispatch(recieveMenus(json)))
  }
}*/


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

