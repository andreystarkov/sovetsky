import React, {PropTypes} from 'react'
import anime from 'animejs'
import imagesLoaded from 'imagesloaded'
import TiltFx from './TiltEngine'
import TiltHoverItem from './TiltHoverItem'

window.TiltFx = TiltFx;

const data = {
  name: 'Test',
  somthing: 'Hey',
  hey: 'eey'
};

export default class TiltHovers extends React.Component {

  handleClick(obj){
    console.log('clicked: ', obj);
  }

  render() {
    return (
      <main>
  			<section className="content content--c1">
          <TiltHoverItem
            src="https://tympanus.net/Development/TiltHoverEffects/img/1.jpg"
            title="Heyeheye"
            description="Hasdasd Uheuehe"
            data={data}
            onClick={this.handleClick.bind(this)}
            filter="5"
          />
          <TiltHoverItem
            src="https://tympanus.net/Development/TiltHoverEffects/img/1.jpg"
            title="Heyeheye"
            description="Hasdasd Uheuehe"
            filter="5"
          />
  			</section>
  		</main>
    );
  }
}
