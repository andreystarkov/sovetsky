import React, { Component } from 'react'
import ASLogo from '../svg/ASLogo'
import Waypoint from 'react-waypoint'
import aniItemsRandom from '../animation/aniItemsRandom'
import $ from 'jquery'

export default class Footer extends Component {
  _handleEnter() {
    aniItemsRandom('.as-logo path, .as-logo-circle', false, 3000, 1000)
   // alert('a');
  }
  _handleLeave() {
    $('.as-logo path, .as-logo-circle').removeClass('animated').css({
      fillOpacity: 0
    })
  }
  render() {
    return (
      <footer className='page-footer svg-bg-2'>
        <Waypoint onEnter={this._handleEnter} onLeave={this._handleLeave} />
        <div className='container'>
          <div className='col-md-6 align-left copy'>
            <span>&copy; 2016, Ресторан Советский</span><br />
            <i>Все права защищены</i>
          </div>
          <div className='col-md-6 align-right'>
            <a href='http://andreystarkov.ru/' target='_blank' className='as-box'>
              <ASLogo />
            </a>
          </div>
        </div>
      </footer>
    )
  }
}
