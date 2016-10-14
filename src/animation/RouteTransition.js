import React from 'react'
import { TransitionMotion, spring } from 'react-motion'

const willEnter = () => ({
  opacity: 0
});

const willLeave = () => ({
  opacity: spring(0)
});

const getStyles = () => ({
  opacity: spring(1)
});

const RouteTransition = ({ children: child, pathname }) => (
  <TransitionMotion
    styles={ [{
      key: pathname,
      style: getStyles(),
      data: { child }
    }] }
    willEnter={ willEnter }
    willLeave={ willLeave }
  >
    { (interpolated) =>
      <div>
        { interpolated.map(({ key, style, data }) =>
          <div
            key={ `${key}-transition` }
            style={ {
              ...styles.wrapper,
              opacity: style.opacity
            } }
          >
            { data.child }
          </div>
        ) }
      </div>
    }
  </TransitionMotion>
);

var styles = {
  wrapper: {
    position: 'relative'
  }
};

export default RouteTransition;
