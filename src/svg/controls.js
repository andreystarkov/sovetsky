import React from 'react';

export function prevIcon(){
  return(
    <div className="carousel-prev">
      <svg xmlns="http://www.w3.org/2000/svg" version="1.1" >
      <g>
        <polygon points="146.883,197.402 45.255,98.698 146.883,0 152.148,5.418 56.109,98.698 152.148,191.98 " />
      </g>
      </svg>
    </div>
  )
}

export function nextIcon(){
  return(
    <div className="carousel-next">
      <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
      <g>
        <polygon points="57.179,223.413 51.224,217.276 159.925,111.71 51.224,6.127 57.179,0 172.189,111.71"/>
      </g>
      </svg>
    </div>
  )
}
