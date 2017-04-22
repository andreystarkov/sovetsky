import React, { Component } from 'react'

import MainNavigation from '../components/MainNavigation'
import Header from '../components/Header'

import Footer from '../components/Footer'
import Contacts from '../components/Contacts'
import MainCarousel from '../components/MainCarousel'
import MenuItems from '../components/MenuItems'
// import Menu from 'react-burger-menu'
import { Parallax } from 'react-parallax'
import MainLogo from '../svg/MainLogo'

var Menu = require('react-burger-menu').push
//   width="512px" height="512px"

class InteriorHeader extends Component {
  render() {
    return (
      <section className='main-header interior-header'>
        <div className='page-navigation container'>
          <MainLogo />
        </div>
        <div className='main-header-container container'>
          {/*            <div className="top-phones">
              <b className="phone"><span>(3532)</span> 55-00-57</b>
              <span className="address">г. Оренбург. ул. Просторная 21/1</span>
            </div> */}

        </div>

      </section>
    )
  }
}

export default class MenuPage extends Component {
  constructor(props) {
    super(props)
    this.state = {
      isOpen: false
    }
  }
  render() {
    return (
      <div>
        <section>
          <MenuItems />
        </section>
        <section>
          <Contacts />
        </section>
      </div>
    )
  }
}
