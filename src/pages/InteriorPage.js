import React, { Component } from 'react'

import InteriorCarousel from '../components/InteriorCarousel'
import Contacts from '../components/Contacts'
import InteriorImages from '../components/InteriorImages'

import MainLogo from '../svg/MainLogo'

class InteriorHeader extends Component {
  render() {
    return (
      <section className='main-header interior-header'>
        <div className='page-navigation container'>
          <MainLogo />
        </div>
        <div className='main-header-container container' />
      </section>
    )
  }
}

export default class InteriorPage extends Component {
  constructor(props) {
    super(props)
    this.state = {
      isOpen: false
    }
  }
  componentWillUnmount() {
    window.scroll(0, 0)
    history.pushState('', document.title, window.location.pathname)
  }
  render() {
    return (
      <div>
        <InteriorCarousel />
        <InteriorImages max={100} />
        <Contacts />
      </div>
    )
  }
}
