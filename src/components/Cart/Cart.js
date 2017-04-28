import React from 'react'

export default class CartComponent extends React.Component {
  render() {
    const { cart } = this.props
    return (
      <div className='the-cart'>
        {cart.map(e => {
          return (
            <div className='cart-item'>
              <b className='name'>{e.title}</b>
              <span className='price'>{e.price}</span>
            </div>
          )
        })}
      </div>
    )
  }
}
