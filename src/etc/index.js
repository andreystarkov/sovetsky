export function pushStorage(item, value){
  var stored = localStorage.getItem(item);
  if ( stored ){
   // console.log('pushStorage: ', stored.length ' >< ', JSON.stringify(value) );
  } else {
    console.log('pushStorage: new', item, value);
    localStorage.setItem(item, JSON.stringify(value));
  }
}
