class Slider {

    constructor(imagesArray, legendArray, time) {
        this.imagesArray = images;
        this.legendes = legendArray;
        this.time = time;
        this.index;
        this.src = document.slide;
        this.text = textSlider;
        this.timer;
        this.addKeyListener();
        this.changeImg();
        this.setImages(imagesArray);
     }

    setImages(images) {
        if(images.length > 1)
            {this.images =  images;} 
        else {alert("Le diaporama est vide");}
    }

    changeImg() {                                                 
        if (this.index < this.images.length - 1)                
            {this.index++;                                       
            this.src.src = this.images[this.index];                   
            this.text.textContent = this.legendes[this.index];}        
        else {this.index = 0;                                      
            this.src.src = this.images[this.index];                     
            this.text.textContent = this.legendes[this.index];}               
            this.timer = setTimeout("this.changeImg()", this.time);             
            //this.timer = setTimeout(this.changeImg.bind(this), this.time)    
    }

    suivant() {                                                        
        if (this.index < this.images.length - 1)                
            {this.index++;                                         
            this.src.src = this.images[this.index];                      
            this.text.textContent = this.legendes[this.index];}                 
        else {this.index = 0;                                        
             this.src.src = this.images[this.index];                         
             this.text.textContent = this.legendes[this.index];}                               
            clearTimeout(this.timer);
            this.timer = setTimeout("this.changeImg()", this.time);              
            clearTimeout(this.timer);                                      
    }

    precedent() {                                            
        if (this.index > 0)                                                      
            {this.index = this.index - 1;                                             
            this.src.src = this.images[this.index];                                     
            this.text.textContent = this.legendes[this.index];}                                
        else {this.index = 3;                                                              
            this.src.src = this.images[3];                              
            this.text.textContent = this.legendes[this.index];}                         
            clearTimeout(this.timer);                                                       
            this.timer = setTimeout("this.changeImg()", this.time);            
            clearTimeout(this.timer);                                                
    }


addKeyListener() {
    $(document).keydown(function(e) {
        if (e.keyCode === 37) {
            this.precedent();
        } else if (e.keyCode === 39) {
            this.suivant();
        }
    });
} 

//////////////////////////////////////////////
//////////////////////////////////////////////



window.addEventListener("load", () => {
    const images = ["image/image1.PNG",
              "image/image2.JPG",
              "image/image3.JPG",
              "image/image4.JPG"];

    var legendes = ['Bienvenue sur VELO CLICK','Vous pouvez utiliser les fleches directionelles du clavier', 'Cliquer sur un vélos là oû vous en desirez un','Puis remplissez le formulaire pour signer'];

    let slider = new Slider(images, legendes, 5000);
});

