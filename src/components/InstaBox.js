import React, { Component } from 'react'

var Instafeed = require('instafeed.js')

class InstaboxHeader extends Component {
  render() {
    return (
      <div>
        <section className='decorative-menu-section main-food-text gallery-header'>
          <div className='container'>
            <div className='row'>
              <div className='col-md-2 col-xs-12'>
                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'>
                  <path d='M366.08 0H145.92C65.707 0 0 65.707 0 145.92v220.16C0 446.293 65.707 512 145.92 512h220.16C446.293 512 512 446.293 512 366.08V145.92C512 65.707 446.293 0 366.08 0zm128.853 366.08c0 70.827-58.027 128.853-128.853 128.853H145.92c-70.827 0-128.853-58.027-128.853-128.853V145.92c0-70.827 58.027-128.853 128.853-128.853h220.16c70.827 0 128.853 58.027 128.853 128.853v220.16z' />
                  <path d='M366.08 51.2H145.92c-52.053 0-94.72 42.667-94.72 94.72v220.16c0 52.053 42.667 94.72 94.72 94.72h220.16c52.053 0 94.72-42.667 94.72-94.72V145.92c0-52.053-42.667-94.72-94.72-94.72zm77.653 314.88c0 42.667-34.987 77.653-77.653 77.653H145.92c-42.667 0-77.653-34.987-77.653-77.653V145.92c0-42.667 34.987-77.653 77.653-77.653h220.16c42.667 0 77.653 34.987 77.653 77.653v220.16z' />
                  <path d='M256 119.467c-75.093 0-136.533 61.44-136.533 136.533S180.907 392.533 256 392.533 392.533 331.093 392.533 256 331.093 119.467 256 119.467zm0 256c-65.707 0-119.467-53.76-119.467-119.467S190.293 136.533 256 136.533 375.467 190.293 375.467 256 321.707 375.467 256 375.467z' />
                  <path d='M256 162.133c-52.053 0-93.867 41.813-93.867 93.867 0 52.053 41.813 93.867 93.867 93.867s93.867-41.813 93.867-93.867-41.814-93.867-93.867-93.867zm0 170.667c-42.667 0-76.8-34.133-76.8-76.8 0-42.667 34.133-76.8 76.8-76.8 42.667 0 76.8 34.133 76.8 76.8 0 42.667-34.133 76.8-76.8 76.8zM392.533 93.867c-14.507 0-25.6 11.093-25.6 25.6s11.093 25.6 25.6 25.6c14.507 0 25.6-11.093 25.6-25.6s-11.093-25.6-25.6-25.6z' />
                </svg>
              </div>
              <div className='col-md-10 col-xs-12'>
                <div className='decorative-section-content'>
                  <h2>Мы в Instagram</h2>
                  <p><a href='https://www.instagram.com/sovrest/'>Подпишитесь на нас</a> и следите за событиями в нашем ресторане.</p>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    )
  }
}

export default class InstaBox extends Component {
  constructor(props) {
    super(props)
    this.state = { data: [], isOpen: false, loaded: false }

    this.openLightBox = this.openLightBox.bind(this)
    this.closeLightbox = this.closeLightbox.bind(this)
  }
  componentDidMount() {
    var data = []
    var userFeed = new Instafeed({
      get: 'user',
      userId: '2921525859',
      accessToken: '2921525859.bd179ef.0c7ef704ab5546529611105a0ab10a96',
      template: '<a href="{{link}}" target="blank" class="interior-item col-xs-6 col-md-3"><div class="interior-image" style="background-image:url({{image}}"></div></a>',
      resolution: 'standard_resolution',
      filter: (the) => {
        data.push(the)
        return the
      }
    })
    userFeed.run()
    console.log('InstaBox: ', data)
    this.setState({
      data: data
    })
  }
  closeLightbox(e) {
    e.stopPropagation()
    this.setState({
      isOpen: false
    })
  }
  openLightBox(index) {
    var images = this.state.data
    this.setState({
      index: index, isOpen: true
    })
  }
  render() {
    return (
      <div>
        <InstaboxHeader />
        <section className='interior-grid'>
          <div id='instafeed' className='container-fluid' />
        </section>
      </div>
    )
  }
}
