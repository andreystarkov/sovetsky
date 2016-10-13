/*
* @Author: Andrey Starkov
* @Date:   2016-10-04 11:26:15
* @Last Modified by:   Andrey Starkov
* @Last Modified time: 2016-10-04 11:27:14
*/

var aniEffects = {
  one: {
    pathOpacityAnim : true
  },

  two: {
    outAnimation: {
      translateX: -25,
      rotateZ: 50,
      opacity: [1, 0],
      duration: 650,
      easing: 'easeInBack'
    },
    inAnimation: {
      delay: 100,
      properties: {
        translateY: {
          value: function() {
            return [-80, 0];
          },
          duration: 1800,
          elasticity: 700,
          easing: 'easeOutElastic'
        },
        translateX: {
          value: function() {
            return [50, 0];
          },
          duration: 1800,
          elasticity: 600,
          easing: 'easeOutElastic'
        },
        rotateZ: {
          value: [-70, 0],
          duration: 1800,
          elasticity: 500,
          easing: 'easeOutElastic'
        },
        opacity: {
          value: [0, 1],
          duration: 850,
          easing: 'linear'
        },
      }
    },
    pathAnimation: {
      duration: 1900,
      easing: 'easeOutQuint',
      delay: 300
    }
  },

  three: {
    pathOpacityAnim: true,
    outAnimation: {
      scale: 0,
      opacity: [1, 0],
      duration: 250,
      easing: 'easeInOutQuad'
    },
    inAnimation: {
      delay: 150,
      properties: {
        scale: {
          value: function() {
            return [0, 1];
          },
          duration: 900,
          elasticity: 600,
          easing: 'easeOutElastic'
        },
        opacity: {
          value: [0, 1],
          duration: 50,
          easing: 'linear'
        },
      }
    },
    pathAnimation: {
      duration: 700,
      easing: 'easeOutSine',
      delay: 200
    }
  },

  four: {
    outAnimation: {
      translateY: [0, 15],
      opacity: [1, 0],
      duration: 350,
      easing: 'easeInBack'
    },
    inAnimation: {
      delay: 130,
      properties: {
        rotateZ: {
          value: function() {
            return [70, 0];
          },
          duration: 1200,
          //elasticity: 500,
          easing: 'easeOutElastic'
        },
        opacity: {
          value: [0, 1],
          duration: 400,
          easing: 'linear'
        },
      }
    },
    pathAnimation: {
      duration: 1000,
      easing: 'easeOutCubic',
      delay: 400
    }
  },

  appearLogo: {
    outAnimation: {
      translateX: -15,
      rotateZ: 20,
      opacity: [1, 0],
      scale: 1.1,
      duration: 250,
      easing: 'easeInBack'
    },
    inAnimation: {
      delay: 100,
      properties: {
        translateY: {
          value: function() {
            return [-20, 0];
          },
          duration: 1400,
          elasticity: 400,
          easing: 'easeOutElastic'
        },
        translateX: {
          value: function() {
            return [15, 0];
          },
          duration: 1300,
          elasticity: 600,
          easing: 'easeOutElastic'
        },
        rotateZ: {
          value: [-30, 0],
          duration: 1700,
          elasticity: 500,
          easing: 'easeOutElastic'
        },
        opacity: {
          value: [0, 1],
          duration: 750,
          easing: 'linear'
        },
      }
    },
    pathAnimation: {
      duration: 1400,
      easing: 'easeOutQuint',
      delay: 300
    }
  }

};

export default aniEffects;
