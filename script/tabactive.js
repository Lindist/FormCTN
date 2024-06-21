class Tab2Active {

    tab1 = document.getElementById('tab1');
    tab2 = document.querySelector('#tab2');
    istab2 = false;
    Active(){
        this.istab2 = true;
    }
    unActive(){
        this.istab2 = false;
    }

}

export default Tab2Active;
