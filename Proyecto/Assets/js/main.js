const  getAbsolutePath = ()=> {
    let loc = window.location;
    let pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    console.log("path "+pathName );
    return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
}