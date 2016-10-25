import React, { Component } from 'react'

import MainNavigation from '../components/MainNavigation'
import Header from '../components/Header'
import Footer from '../components/Footer'
import InteriorCarousel from '../components/InteriorCarousel'
import {Contacts, TheMap} from '../components/Contacts'
import InteriorImages from '../components/InteriorImages'
import { Parallax } from 'react-parallax'
import MainLogo from '../svg/MainLogo'
import $ from 'jquery'
import anime from 'animejs'
var Menu = require('react-burger-menu').push;
import initAniEffects from '../animation/initAniEffects'
import aniEffects from '../animation/aniEffects'
import RouteTransition from '../animation/RouteTransition'
import drawSVGPath from '../animation/drawSVGPath'
import { drawStar } from '../pages/IndexPage'

export class MainLogoLoading extends Component {
    render() {
        return (
          <div className="main-logo-wrapper content--1">
          <svg className="main-logo letters--effect-1 main-logo-loading" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 311.12224 130.54229">
            <g>
              <g className="letter letter--1">
                <g className="letter__part">
                  <path className="path letter__layer path-1" d="M96.504 56.967c-9.81 4.95-11.34.36-9.81-.45 0 0 2.25-1.08 2.7-2.16.45-1.08.99-3.42 2.7-4.77 1.71-1.35 5.13-3.51 8.91-1.08 3.78 2.43 5.31 3.51-4.5 8.46zm-2.52-14.22c-6.93 7.11.63.81-9.63 8.91-2.25 1.8 1.44 1.98-16.74 11.16-18.18 9.09-32.04 15.57-46.08 14.4-13.59-1.08-12.87-8.01-12.87-11.34 0-3.24 8.91-20.07 20.52-30.6 10.62-9.63 24.84-15.93 36.54-20.52s22.68-6.93 29.61-.81c4.77 4.23 1.44 8.73-1.08 11.52-2.52 2.7 2.88 0 .18 4.41-2.7 4.41 21.87-13.68 16.02-23.85 0 0-10.62-14.31-49.23 1.17s-52.92 44.01-55.35 48.42c-4.59 8.37-4.41 20.43 6.03 24.57 10.35 4.23 22.59.72 34.47-3.6 11.88-4.41 30.42-14.94 33.12-15.84 2.7-.9-1.35 3.87 5.31 6.21 6.57 2.34 18.36-8.64 20.61-13.14 1.62-3.24 3.6-5.58 3.42-9.63-.09-2.52-7.83-8.37-14.76-1.26z" />
                </g>
              </g>
              <g className="letter letter--2">
                <g className="letter__part">
                 <path className="path letter__layer path-2" d="M129.354 26.457s5.04-9.9 16.56-16.56c4.68-2.7 8.1-4.68 7.74-3.06-2.43 12.42-21.15 20.07-24.3 19.53zm17.1-20.88c-7.74 4.77-16.2 13.14-20.61 21.6 0 0-.36 1.17-4.77 1.17-4.41 0-5.85-.27-7.2 0-1.35.27.09.45-.72.72-.81.27-3.24 2.97-2.88 3.69.36.72-.99 1.08-1.26 1.26-.27.18.81 1.8 2.43 2.43 1.62.63 6.03.99 8.1.72 0 0-13.23 18.81-12.96 25.83.27 7.02 6.84 4.14 12.15-.45 5.31-4.59 8.46-10.71 9.45-13.14.99-2.43.45-5.58-2.88-6.48-3.42-.81-5.49 2.34-7.02 5.13-1.62 2.79-1.8 4.23-1.44 4.86.36.63-.27-1.53 2.34-.72 2.52.72 1.35.45 2.43 0s2.07.63.99 1.98c-1.08 1.35-7.74 5.85-10.53 4.14-2.79-1.71 5.49-12.96 6.66-14.67 1.26-1.71 4.77-6.66 5.94-7.38 1.17-.72 8.46-1.08 15.21-7.38 1.17-1.08 3.51-3.06 6.39-5.58 5.85-5.22 13.5-12.78 15.3-19.17 1.35-4.95-6.3-3.87-14.94 1.44zM137.634 48.147c1.8-1.26 3.69-2.16 5.22-1.8 2.7.63 3.24 1.08-1.71 2.88-5.4 1.98-9.27 4.86-9.27 4.86.45-1.35 4.05-4.68 5.67-5.94zm17.73 1.08c-1.44 1.71-5.04 5.49-6.21 6.12-1.17.72-2.25 1.44-3.87 2.52s-1.8.81-7.2 2.43c-2.34.72-4.5.54-5.31-.09-.9-.63-2.25-1.62.72-2.16 2.16-.45 12.24-6.3 14.22-8.37 1.98-2.07 4.95-7.2 4.14-8.64-.81-1.53-9.45-1.17-13.05 1.35-3.6 2.52-6.57 5.85-10.35 13.5-3.69 7.65 0 10.62 0 10.62 3.33 1.53 7.02.09 11.16-1.62 4.05-1.71 11.43-7.56 12.42-8.37 1.08-.81 4.95-9.36 3.24-7.29z" />
                </g>
              </g>
              <g className="letter letter--3">
                <g className="letter__part">
                  <path className="path letter__layer path-3" d="M183.174 61.376c-1.08.72-3.42 2.34-5.85 3.33-2.43.99-5.13 2.16-6.12 1.62-.99-.54 3.15-7.92 3.6-9.45.45-1.62 1.17-2.7 1.08-4.23-.09-1.53-3.6-.63-4.68 0-1.08.63-2.16 1.26-2.79 2.7-.63 1.44-6.57 9.9-6.93 10.71-.45.81-1.35.18-1.35 0-.09-.27-.54-3.51 1.62-7.56 2.16-3.96 2.16-4.95 1.53-6.21-.63-1.26-5.4 1.17-6.84 3.06-1.53 1.89-3.6 4.23-4.23 5.31-.72 1.08-3.6 5.49-4.68 5.76 0 0-.81.09 1.17-4.95 2.07-4.95 2.7-6.93 5.31-10.44 2.61-3.51 6.03-7.11 7.11-8.01.99-.9 1.62-.54.45 1.08-1.17 1.62-.72 2.61.72 1.62 1.44-.99 2.25-1.26 4.14-1.98 1.89-.63 3.78-.99 3.78.99s-.27 2.25 0 2.7c.27.36 1.26.27 2.07-.27.81-.54 2.88-1.8 4.86-2.43 2.07-.63 3.15-.99 4.14-1.08.99-.09 0 5.04-.9 7.11-.81 2.07-2.7 6.39-2.52 7.11.18.72 1.26.09 3.06-.36 1.62-.45 4.77-2.97 5.22-2.7.54.27-1.62 5.85-2.79 6.57zM194.603 58.137c-1.44-.27-2.25-2.25-1.62-4.59.54-2.34 2.52-5.67 4.23-6.21 1.71-.54 5.13-.54 5.04 0-.09.54-1.62 2.97-1.44 3.6.18.63 2.88-1.62 3.87-2.7.99-.99 3.6-4.14 3.87-4.77.27-.54 1.53-1.44-1.44-2.52-3.06-1.08-5.58-1.17-9.81 2.34-4.23 3.6-9.72 11.61-10.44 16.83-.72 5.22.18 5.94 3.33 6.03 0 0 5.76-.72 11.97-4.32 6.12-3.6 7.65-4.59 10.53-6.84 1.17-.9-2.16 4.86-3.06 7.11-.9 2.25-1.44 3.96-.99 4.77.45.81 2.97-1.71 3.87-2.61.9-.99 1.98-2.61 3.15-4.5 1.98-3.15 5.13-9.54 10.08-10.89 2.88-.81 7.92-1.35 8.64-1.35.72.09.18 1.35.18 1.53 0 .18 2.16-.81 3.87-2.52 1.62-1.71 3.24-4.32 3.78-5.13.54-.81-.36-1.08-2.43-.63-2.07.45-10.62 1.35-13.68 3.33-3.06 1.98-2.25 1.08-2.25.63.09-1.8 2.25-3.24 1.26-4.14-.27-.27-2.43.63-4.32 2.61-1.89 1.89-2.7 4.68-7.65 7.56-5.31 3.06-13.05 8.37-18.36 7.47z" />
                </g>
              </g>
              <g className="letter letter--4">
                <g className="letter__part">
                  <path className="path letter__layer path-4" d="M220.703 66.056c-.99-.54-3.42-1.98-1.71-6.93 1.8-4.95 5.58-7.74 5.76-7.92.18-.09 1.44-.09.72 3.24-.63 3.24 3.42 3.33 4.14 2.97.72-.36 10.8-7.38 14.76-10.98 4.05-3.6 3.6-2.7 7.29-5.22 3.69-2.52.9 1.98-.63 3.96-1.53 1.89-5.85 7.02-6.21 9.09-.36 2.16-.18 4.14.36 4.77.54.63 7.47-3.96 8.37-5.04.9-1.08 5.58-7.92 6.75-9.18 1.17-1.35 3.87-3.51 4.95-3.96 1.08-.45 3.06-.63 2.79.63s-1.62 3.87-2.79 4.86c-1.17.99-6.12 5.58-6.21 6.84-.18 1.26-.27 3.33.18 4.05.45.72 8.64-4.5 9.18-5.49.54-.99 6.66-9.18 10.17-10.62 3.42-1.44 3.06.27 3.15.81.09.54-2.97 4.59-4.77 6.03-1.8 1.44-4.95 7.74-4.41 9.09.54 1.35 9-2.61 10.08-3.87 3.6-3.87 6.3-9.81 11.88-12.51.9-.45 2.07-.27 1.89.9-.18 1.17-.27 4.41-1.17 5.67-.81 1.08-5.22 5.49-6.84 7.29-1.08 1.17-2.16 8.28 1.89 6.21.81-.36 3.96-2.61 4.95-1.62.18.18-1.53 1.8-2.88 2.97-1.35 1.17-3.33 2.7-6.03 3.69-7.11 2.7-5.31-4.5-4.59-5.85.27-.45-1.89-.81-4.68.81s-9.36 6.93-10.98 5.49c-1.62-1.44-.09-8.01-.36-8.82-.27-.9-12.69 12.06-13.5 7.83-.81-4.23.54-7.92-1.71-5.94-2.25 1.98-10.89 7.2-11.79 6.84-2.97-1.08 1.89-11.07-.54-9.45-.99.72-14.94 10.89-17.64 9.36zM267.143 24.297s-.9 7.47 9.54 8.01 19.08-3.51 27.54-11.43 6.84-7.74 6.66-8.91c-.18-1.17-4.41-3.24-6.03-3.42-1.62-.18-2.25-.45-4.86 1.17-2.52 1.62-4.86 2.79-4.86 4.23 0 1.35 1.26-1.53 4.05-.45 2.7 1.08 6.03 3.33 4.68 4.86-1.35 1.44-2.25 4.77-13.5 7.65-11.16 2.88-15.21-3.51-15.75-5.94-.54-2.34-.9-1.08-1.8-.36-.9.72-4.05 2.79-4.23 3.24-.18.45.36 1.17-.18 1.17s-1.26.18-1.26.18zM163.554 39.957s1.53-3.87 4.23-5.13c2.61-1.26 11.34-2.16 14.58-2.79 3.24-.63 9.18-1.98 10.98-1.53 1.8.45-5.22 6.12-6.12 7.02-.9.9-8.82.27-12.6.54-3.78.27-3.96.81-4.95 1.17-.99.27-5.4 1.08-6.21.72zM239.513 108.266c-1.17.36-3.96 1.53-4.68 1.17-1.26-.72 1.35-4.59 4.32-6.21 1.08-.63 5.22-.18 5.31.9.09 1.08-3.06 3.69-4.95 4.23zm-47.25-3.15c-1.17 2.07-6.66 5.58-10.89 4.41-2.43-.72.36-1.35 1.98-1.35 1.26 0 .99-1.26 1.62-1.98.63-.72 2.52-2.43 3.69-2.7 1.08-.36 4.77-.45 3.6 1.62zm-92.16 2.52c-1.26-1.26 1.71-4.32 3.6-4.05 2.97.45-3.6 4.05-3.6 4.05zm204.48.99c-3.06.63-8.73 1.53-15.48 1.71-6.57.18-14.58 0-18.45-1.44-1.44-.54-1.17-1.8-.45-2.61.72-.9 4.68-3.69 2.88-4.32-1.26-.45-2.79-.54-4.41 1.44-1.71 1.98-2.25 2.25-3.24 2.07-1.98-.36 2.43-3.33 1.53-4.23-.9-.9-1.71-.9-2.97.27-7.74 7.11-17.1 8.28-18.09 8.37-.99.09.45-2.07 1.26-2.7 1.17-.99.45-1.98-.72-1.8-.81.18 3.78-2.79-1.26-3.69-5.49-.99-7.56-1.17-12.51 5.04-.72.9-13.77 4.32-14.04 1.44-.18-1.89.81-3.42 1.89-4.68 1.08-1.26.18-1.53-1.53-1.8-1.71-.36-3.96.27-3.96.27s-.09-1.35.54-3.15c.72-1.89 1.26-2.43 2.16-3.87.45-.72-3.24-1.44-3.24-1.44-11.97 12.87-16.92 12.96-19.44 12.96-.81 0 2.52-4.14-2.25-5.4-5.22-1.35-8.82 3.51-9.54 4.05-.81.54-1.89-.99-5.85.63-3.87 1.71-9.36 5.85-11.07 3.78-1.44-1.71-2.34-3.78-1.8-5.94.45-2.16-2.25-3.42-6.39-.72s1.71-3.87-5.31-1.26c-6.93 2.61-3.69 2.16-5.04-.81-.54-1.17-1.26-.81-1.98 0s-.81 2.7-2.16 3.78c-.63.54-6.39 2.43-11.7 3.78-4.68 1.17-10.8 2.79-10.17-.81 1.17-6.75 4.05-3.06 2.79-2.16-1.26.9 1.35 1.98 2.07.27.72-1.8.36-2.97-.9-3.78-1.26-.81-2.79-.72-4.05-.18-1.26.54-2.52 2.25-3.06 3.51-.63 1.62-7.83 3.15-10.26 3.51-2.43.36-5.31 1.08-6.57.09-1.17-.99 3.78-1.08 4.59-3.96s-.09-4.14-2.79-3.33c-2.7.81-6.48 3.69-6.12 6.57.27 2.16-11.43 1.26-11.43.18 0-1.89.18-3.06 1.08-4.77.81-1.53.09-1.62-1.62-1.89-1.71-.36-4.77.45-4.77.45s2.7-5.76 3.33-7.65c.18-.54-3.96-.18-4.41.63-1.08 2.34-2.52 5.85-3.78 9-4.048 4.41-21.598 6.12-35.638 5.94-25.83-.36-31.23-1.89-38.7-2.88-1.53-.18-1.89.72-1.26 1.8.9 1.53 2.88 1.98 3.78 2.16 12.06 1.71 24.75 1.71 36.63 1.71 7.92 0 26.55-.72 33.48-4.23-.72 1.98-1.17 3.06-.99 2.61 1.44-3.15-7.02 15.48-6.66 18.45.18 1.71 2.52.72 2.61 0 .09-.72 5.31-13.32 7.47-18.63 2.16-5.31 1.98-4.68 4.86-5.58 2.88-.99 2.43.81 1.98 2.43-.36 1.62-.9 2.88 1.53 3.69 1.44.54 11.61 1.26 14.13-1.53 0 0 0 .81 1.8 1.53 1.8.81 4.86.54 10.35-.99 5.49-1.53 6.48-2.16 6.84-2.25.36-.09.09 1.8 3.51 3.24 3.33 1.44 8.73-.09 11.43-.9 2.61-.81 7.29-2.25 8.64-2.88 1.44-.63-1.17 1.44-.45 3.15.72 1.8 1.17 1.17 1.17 1.17s3.33-4.68 6.3-6.03c1.98-.9 4.14-1.26 5.31-1.44 2.16-.27-2.79 5.85-.27 7.47.54.36 3.87-4.86 4.86-5.94 1.08-1.08 2.88-1.62 3.24-1.44.81.36-.36 3.06 2.34 6.12 3.42 3.96 10.35-.9 12.24-1.62 1.89-.72.63 1.98 3.15 2.97 2.52.99 6.12.27 9.628-1.26.99-.45 2.52-.9 3.6-2.07.27-.27 2.25 1.62 8.73-1.53 4.68-2.34 10.53-7.83 10.53-7.83s-5.85 13.5-7.29 16.65c-1.44 3.15-4.5 11.25-4.59 12.96-.09 1.71 2.52.72 2.61 0 .09-.72 5.4-13.32 7.47-18.63 2.16-5.31 1.26-4.14 4.14-5.13 2.88-.99 1.62 1.44 1.26 3.06-.36 1.62.36 3.06 2.88 3.42 6.03.72 13.23-2.34 13.14-1.89-.36 4.5 8.1 1.44 9 .81 4.05-2.97.99 1.8 4.95 1.17 1.71-.27 7.11-.63 14.49-4.77 1.8-.99-.18 1.62-.72 2.7s-.09 1.53.72 1.98c1.62.81 3.33-3.51 4.14-3.06 1.44.72 2.52-.45 3.06-.72.45-.27-1.35 2.7 2.43 3.51 4.41.9 10.53 1.53 17.64 1.35 12.15-.36 16.02-.81 17.64-1.98.63-.45.63-2.34-.45-2.07z" />
                </g>
              </g>
            </g>
          </svg>
        </div>
        )
    }
}

var isAnimating = false;

/*  componentWillUpdate(){
    var elem = document.getElementById('page-preloader');

    if( !isAnimating) {
        elem.style.visibility = "visible";
        isAnimating = true;
        var myAnimation = anime({
        targets: elem,
        opacity: {
          value: [0, 1],
          duration: 1000
        }, complete: () => {
            setTimeout( () => {
              var myAnimation = anime({
                targets: elem,
                opacity: {
                  value: [0, 1],
                  duration: 1000
                },
                direction: 'reverse',
                complete: () => {
                  console.log('did update');
                  isAnimating = false;
                  elem.style.visibility = "hidden"
                }
              });
            }, 500);
        }
      });
    } else {
      console.log('Double animating attempt');
    }
  }*/

/*    $.scrollify({
        section : ".scroll-section",
        sectionName : "section-name",

        easing: "easeOutExpo",
        scrollSpeed: 900,
        offset : 0,
        scrollbars: true,
        standardScrollElements: "",
        setHeights: true,
        overflowScroll: true,
        before:function() {},
        after:function(e) {
          console.log('scrolled: ', e);
        },
        afterResize:function() {},
        afterRender:function() {
          alert('a');
        }
    });*/

/*var FullscreenPreloaderStyles = {
  position: 'fixed',
  zIndex: '9999999',
  left: '0', top: '0', right: '0', bottom: '0',
  width: '100%', height: '100%',
  textAlign:'center',
  padding:'5%',
  display:'flex',
  alignItems: 'center',
  justifyContent: 'center',
  backgroundColor: '#fff'
};*/

export class FullscreenPreloader extends Component {

  componentDidMount(){
   initAniEffects();
    var svgFx = document.querySelector('.letters--effect-1'),
        aniLogo = new Phrase(svgFx, aniEffects.appearLogo);

   drawSVGPath('.letter__layer');

   console.log('Location: ',location.pathname);

   setTimeout( () => {
      if ( location.pathname == '/index' || location.pathname == '/' ) drawStar();
      anime({
        targets: '#fullscreen-preloader',
        rotateX: [0,'90deg'],
       // translateY: [0, -500],
       // borderRadius: [0, 1000],
       // translateY: [0, 2000],
       // opacity: 0,
        perspective: 200,
        duration: 1000,
        easing: 'easeInOutQuint',
        complete: () => {
          $('#fullscreen-preloader').addClass('hidden');
          aniLogo.animate();
          window.isLoaded = true;
        }
      })
   },2300);
  }

  render(){
    return(
      <div className="fullscreen-preloader" id="fullscreen-preloader">
        <MainLogoLoading />
      </div>
    )
  }

}

export default class PageContainer extends Component {

  componentDidMount(){

    $(document).on('click', '.bm-menu .nav-item', function(){
      $('.bm-cross-button button').click();
      $(window).scrollTop(0);
    //  history.pushState('', document.title, window.location.pathname);
    });

/*    var docHeight = $('.section-header').height()-150,
        navigation = $('.page-navigation');

    $(document).on('scroll', function(){
      if( ($(this).scrollTop() > docHeight) ){
        navigation.addClass('scrolled')
      }
      if( ($(this).scrollTop() < docHeight) ){
        navigation.removeClass('scrolled')
      }
    });*/

    window.addEventListener('scroll', this.handleScroll);
  }
  handleScroll(event){
    let scrollTop = event.srcElement.body.scrollTop;
    //console.log('scroll: event',event, 'scrolltop: '+scrollTop);
    if ( scrollTop > 100 ){
      $('.page-navigation').addClass('scrolled');
    } else {
      $('.page-navigation').removeClass('scrolled');
    }
  }
  componentWillUnmount() {
    window.removeEventListener('scroll', this.handleScroll);
  }
  componentDidUpdate(){
   window.scroll(0, 0);

   // $(window).scrollTop(0);
   // $.scrollify.update()

  }
  render() {
      return (
          <div id="top-wrapper" data-path={location.pathname}>
            <FullscreenPreloader />
            <Menu pageWrapId={ "page-wrapper" }  outerContainerId={ "top-wrapper" } right>
              <MainLogo />
              <MainNavigation path={location.pathname} />
            </Menu>
            <div id="page-wrapper">

                <div className="page-navigation-wrapper">
                  <div className="page-navigation top-logo-square container">
                    <div className="container">
                      <div className="row">
                        <div className="col-md-3 top-logo-container">
                          <MainLogo />
                        </div>
                        <div className="col-md-9">
                          <MainNavigation path={location.pathname} />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div className="page-content-wrapper">
                  <RouteTransition pathname={ location.pathname }>
                      {this.props.children}
                  </RouteTransition>
                </div>

                <TheMap />
                <Footer />
            </div>
          </div>
      );
  }
}

