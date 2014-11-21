function popUp(URL,pu_Width) {
pu_Width = pu_Width || 1024;
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=yes,location=0,statusbar=0,menubar=0,resizable=1,width=' + pu_Width + ',height=768,left = 128,top = 128');");
}
