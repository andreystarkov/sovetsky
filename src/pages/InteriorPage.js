import React, { Component } from 'react'

import MainNavigation from '../components/MainNavigation'
import Header from '../components/Header'
import Footer from '../components/Footer'
import InteriorCarousel from '../components/InteriorCarousel'
import Contacts from '../components/Contacts'
import InteriorImages from '../components/InteriorImages'
import { Parallax } from 'react-parallax'
import MainLogo from '../svg/MainLogo'

var Menu = require('react-burger-menu').push;


class InteriorHeader extends Component {
  render() {
    return(
      <section className="main-header interior-header">
          <div className="page-navigation container">
            <MainLogo />
          </div>
          <div className="main-header-container container">
          </div>

      </section>
    )
  }
}

export default class InteriorPage extends Component {
  constructor(props) {
    super(props);
    this.state = {
      isOpen: false
    };
  }
  componentWillUnmount(){
       window.scroll(0, 0);
       history.pushState('', document.title, window.location.pathname);
  }
  render() {
      return (
      <div>
        <InteriorCarousel />
        <InteriorImages />
        <Contacts />
      </div>
      );
  }
}

