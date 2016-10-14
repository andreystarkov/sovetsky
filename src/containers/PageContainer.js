import React, { Component } from 'react'

import MainNavigation from '../components/MainNavigation'
import Header from '../components/Header'
import Sidebar from '../components/Sidebar'
import Footer from '../components/Footer'
import InteriorCarousel from '../components/InteriorCarousel'
import Contacts from '../components/Contacts'
import InteriorImages from '../components/InteriorImages'
//import Menu from 'react-burger-menu'
import { Parallax } from 'react-parallax'
import MainLogo from '../svg/MainLogo'

var Menu = require('react-burger-menu').push;
//   width="512px" height="512px"


export default class PageContainer extends Component {
  render() {
      return (
          <div id="top-wrapper">
            <Menu pageWrapId={ "page-wrapper" }  outerContainerId={ "top-wrapper" } right>
              <MainLogo />
              <MainNavigation />
            </Menu>
            <div id="page-wrapper">
                <div className="page-navigation container">
                  <MainLogo />
                </div>

                <div className="page-content-wrapper">
                    {this.props.children}
                </div>

                <Contacts />

                <Footer />
            </div>
          </div>
      );
  }
}

