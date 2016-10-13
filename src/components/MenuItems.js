import { bindActionCreators } from 'redux'
import React, { Component } from 'react'
import { connect } from 'react-redux'
import { fetchMenuItems } from '../actions'
import { default as swal } from 'sweetalert2'
import $ from 'jquery'
import {api} from '../config'

function isEmpty(obj) {
    for(var key in obj) {
        if(obj.hasOwnProperty(key))
            return false;
    }
    return true;
}

var confirmModalSettings = {
    confirmButtonText: 'Продолжить',
    cancelButtonText: 'Отменить',
    showCancelButton: true,
    padding: '50',
    buttonsStyling: false,
    customClass: 'modal-confirm'
}

export class MenuItems extends Component {
  componentWillMount() {
      const { fetchMenuItems } = this.props;
      fetchMenuItems();
  }
  orderClick( obj, e){
    // console.log('orderClick', e, obj);

    swal({
      type: 'question',
      title: 'Подветждение заказа',
      text: 'Наш менеджер свяжется с вами!',
      html: 'Вы выбрали блюдо <b>"' + obj.title + '"</b><br>'+
            'Стоимость: <b>'+obj.price+'</b> Р.',
            ...confirmModalSettings
    }).then( (result) => {
      if( result ){
          swal({
            type: 'question',
            title: 'Введите ваш номер телефона',
            input: 'text',
            ...confirmModalSettings,
            inputValidator: (value) => {
              return new Promise( (resolve, reject) => {
                if (value) {
                  $.get(api.mail+'/?phone='+value, (response) =>{
                   // console.log('Mailer: ', response);
                  });
                  resolve();
                } else {
                  reject('Введите номер телефона!')
                }
              })
            }
          }).then(function(result) {

            if(result) swal({
              type: 'success',
              title: 'Спасибо за заказ!',
              html: 'В ближайшее время мы позвоним вам на номер ' + result + ', для уточнения деталей',
              ...confirmModalSettings
            })
          })
      }

    });
  }
  render(){

    var menu = this.props.menu,
        items,
        self = this;

   // console.log('MenuItems render: ', menu, this.props);

    if ( !isEmpty(menu) ) {
      items = menu.items.map( (obj, key) => {
        return(
          <div key={key} className="catalog-grid-item col-md-3">
            <div onClick={self.orderClick.bind(this, obj)} className="catalog-item">
              <div className="catalog-item-overlay">
                <div className="catalog-caption">
                  <b className="catalog-name">{obj.title}</b>
                  <span className="catalog-description">{obj.description}</span>
                </div>
                <div className="catalog-params">
                  <span className="catalog-price">{obj.price} г.</span>
                  <span className="catalog-weight">{obj.weight} Р.</span>

                  <button className="button-square-buy">Заказать</button>

                </div>
              </div>
              <img src={obj.image.sizes.thumbnail.source_url} />
            </div>
          </div>
        )
      });
    }

   // console.log('MenuItems: ', this.props.menu, this.state);

    return(
    <section className="section-catalog">
      <div className="container-fluid">
        <div className="row">
          {items}
        </div>
      </div>
    </section>
    )
  }
}

function mapStateToProps(state) {
    const menu = state.menu;

    //console.log('mapStateToProps (menu): ', state, menu);

    return {
       menu: menu
    };
}

export default connect(
    mapStateToProps,
    { fetchMenuItems }
)( MenuItems );
