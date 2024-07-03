var load = document.getElementsByClassName('load')[0];
var iconLoad = document.getElementsByClassName('icon-load')[0];
export function loadInit() {
    load.classList.toggle("spinner-border")
    iconLoad.classList.toggle("display-load-icon")
}
