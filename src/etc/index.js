export function pushStorage(item, value){
  var stored = localStorage.getItem(item);
  if ( stored ){
   // console.log('pushStorage: ', stored.length ' >< ', JSON.stringify(value) );
  } else {
   // console.log('pushStorage: new', item, value);
    localStorage.setItem(item, JSON.stringify(value));
  }
}

var breakPoints = [640, 960, 1024, 1280, 1440, 1600, 1920];

export function addSrcSet(obj){
  var srcSet = '';

 var result = breakPoints.map((breakpoint, key) => {
    if( obj.sizes[breakpoint] ) srcSet += obj.sizes[breakpoint].source_url+' '+breakpoint+'w,';
 });

 if( obj.sizes.mobile_crop_h ) srcSet += obj.sizes.mobile_crop_h.source_url+' 320w';

  return srcSet;
}
