import React, { Component } from 'react'
import { Link } from 'react-router'
import { fetchMenus } from '../actions'
import { connect } from 'react-redux'

export class MainNavigation extends Component {
    componentWillMount() {
        const { fetchMenus } = this.props;
        fetchMenus();
    }
    render() {
      var menuData = this.props.menus;

      if( menuData.menus.length > 0 ){
        var menuItems = menuData.menus[0].items.map( (obj, key) => {
          console.log('menus loop: ', obj);
          return(
            <Link to={'/'+obj.slug} className="nav-item" key={key} activeClassName="active">{obj.title}</Link>
          )
        })
      }
        return (
            <div className="main-navigation-wrapper">
                <nav className="main-navigation">
                    <Link to="/" className="nav-item" activeClassName="active" onlyActiveOnIndex={true}>Home</Link>
                    {menuItems}
                </nav>
            </div>
        );
    }
}

function mapStateToProps(state) {
    const menus = state.menus;

    console.log('mapStateToProps: ', state, menus);

    return {
        menus: menus
    };
}

export default connect(
    mapStateToProps,
    { fetchMenus }
)(MainNavigation);
