import { bindActionCreators } from 'redux'
import React, { Component } from 'react'
import { connect } from 'react-redux'
import { fetchMenuItems } from '../actions'
import { default as swal } from 'sweetalert2'
import { addUserProfile, getUserProfile } from '../etc'
import $ from 'jquery'
import {api} from '../config'
import _ from 'underscore'

function isEmpty(obj) {
    for(var key in obj) {
        if(obj.hasOwnProperty(key))
            return false;
    }
    return true;
}

var modalSettings = {
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

    var userProfile = getUserProfile(),
        inputDefault = userProfile.phone || '';

    swal({
      type: 'question',
      title: 'Подветждение заказа',
      text: 'Наш менеджер свяжется с вами!',
      html: 'Вы выбрали блюдо <b>"' + obj.title + '"</b><br>'+
            'Стоимость: <b>'+obj.price+'</b> Р.',
            ...modalSettings
    }).then( (result) => {

      if( result ){
          swal({
            type: 'question',
            title: 'Введите ваш номер телефона',
            input: 'text',
            inputValue: inputDefault,
            ...modalSettings,
            inputValidator: (value) => {
              return new Promise( (resolve, reject) => {
                if (value) {
                  var query = api.mail+'?phone='+value+'&food='+_.escape(obj.title+'<br><br><b>Стоимость:</b> '+obj.price);

                  var user = {
                    phone: value
                  };

                  // console.log('LS | Add User: ', user);

                  addUserProfile(user);

                  $.get(query, (response) =>{
                  // console.log('Mailer: ', response);
                  });
                  resolve();
                } else {
                  reject('Введите номер телефона!')
                }
              })
            }
          }).then(() => {

           swal({
              type: 'success',
              title: 'Спасибо за заказ!',
              html: 'В ближайшее время мы перезвоним вам для уточнения деталей заказа.',
              ...modalSettings
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
        console.log('a', obj);
        return(
          <div key={key} className="catalog-grid-item col-md-3 col-xs-6 col-xxs-12">
            <div className="catalog-item">
              <div className="catalog-item-overlay">
                <div className="catalog-caption">
                  <b className="catalog-name">{obj.title}</b>
                  <span className="catalog-description">{obj.description}</span>
                </div>
                <div className="catalog-params">
                  <span className="catalog-price">{obj.price} г.</span>
                  <span className="catalog-weight">{obj.weight} Р.</span>
                  <button onClick={self.orderClick.bind(this, obj)} data-name={obj.title} data-price={obj.price} className="button-square-buy">Заказать</button>

                </div>
              </div>
              <img src={obj.sizes.thumbnail.source_url} />
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

    // console.log('mapStateToProps (menu): ', state, menu);

    return {
       menu: menu
    };
}

export default connect(
    mapStateToProps,
    { fetchMenuItems }
)( MenuItems );
