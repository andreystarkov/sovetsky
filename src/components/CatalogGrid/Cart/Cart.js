import React from 'react'
import { Col, Button } from 'reactstrap'
import anime from 'animejs'
import './Cart.less'

export default class CartComponent extends React.Component {
  cartRemove(item) {
    if (this.props.onRemove) this.props.onRemove(item)
  }
  getTotal() {
    let total = 0
    const items = this.props.items
    if (items && items.length) {
      items.map(e => (total += parseInt(e.price)))
    }
    return total
  }
  componentDidMount() {
    anime({
      targets: this.cart,
      translateY: [100, 0],
      easing: 'linear',
      duration: 300,
      elacity: 300
    })
    console.log(this.cart)
  }
  render() {
    const items = this.props.items
    const total = this.getTotal()
    return (
      <div className='the-cart' ref={e => { this.cart = e }}>
        <Col xs={12} md={9}>
          {items.map((e, i) => {
            return (
              <div className='cart-item' onClick={this.cartRemove.bind(this, e)}>
                <b className='name'>{e.title}</b>
                <span className='price'>{e.price}</span>
              </div>
            )
          })}
        </Col>
        <Col xs={12} md={3} className='cart-summary'>
          <Col md={5}>
            {total ? <span className='cart-total'> {total} Р. </span> : ''}
          </Col>
          <Col md={7}>
            <Button>Готово</Button>
          </Col>
        </Col>
      </div>
    )
  }
}
