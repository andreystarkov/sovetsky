import React, { Component } from 'react'

import MainNavigation from '../components/MainNavigation'
import Header from '../components/Header'
import Footer from '../components/Footer'
import Contacts from '../components/Contacts'

import { Parallax } from 'react-parallax'
import MainLogo from '../svg/MainLogo'

export default class First extends Component {
  constructor(props) {
    super(props);
    this.state = {
      isOpen: false
    };
  }
  componentDidMount(){

  }
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

                {this.props.children}

                <Footer />
            </div>
          </div>
      );
  }
}
