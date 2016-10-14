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

class MainHeader extends Component {
  render() {
    return(
      <section className="main-header">
        <Parallax bgImage="http://sovetsky.dev/wp-content/uploads/2016/10/DSC01974.jpg" strength={600}>
          <div className="main-header-container container">

          </div>
        </Parallax>
      </section>
    )
  }
}

export default class ContactsPage extends Component {
  render() {
      return (
          <div>
            <MainHeader />
          </div>
      );
  }
}

