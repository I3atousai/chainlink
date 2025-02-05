const BASE_URL = "http://chainlink"


function work_modal(id_modal) {
    const modal = document.getElementById(id_modal)
    if (modal) {
        modal.classList.toggle('active')
    }
}
