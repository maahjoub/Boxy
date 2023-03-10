let all_mony = document.getElementById('all_mony')
console.log(all_mony)
document.onload = () => {
    function numbersWithComa(n) {
        return n.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g,",");
    }
}


