console.log('proVersion');


class Builder {
  constructor(){
    this.config;
    this.pathname = window.location.pathname;
    this.category;
    this.city;
    this.heroesTemplates = {};
    this.offersTemplates = {};
    this.mainTop = document.getElementById('main-top');
    this.mainContent = document.getElementById('main-content');
    this.mainSpinner = document.getElementById('main-spinner');
    this.mainBottom = document.getElementById('main-bottom');
    this.heroes = document.querySelectorAll('.hero-template');
    this.offers = document.querySelectorAll('.template-offer');
    this.templatesContainer = document.querySelector('.templates-container');
    this.vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
    this.vh = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0);
    this.templateFaq = document.getElementById('template-faq');
    this.faqItemTemplate = document.getElementById('template-accordion-item');
    this.bannerSideBySideTemplate = document.querySelector('.template-offer-banner');
    this.bannerColumnTemplate = document.querySelector('.template-offer-banner-column');
    
    this.templateHowItWorks = document.getElementById('template-how-it-works');
    
    this.init();
  }
  init(){
    let that = this;
    that.processTemplates();

    that.config = configLocationData;
    that.validateConfig();
//     this.getConfig(function(response){
//       // Parse JSON string into object
//     });
    
    that.initComplete();
  }
  getConfig(callback) {
    let xobj = new XMLHttpRequest();
    xobj.overrideMimeType("application/json");
    xobj.open('GET', '/config.json', true); // Replace 'my_data' with the path to your file
    xobj.onreadystatechange = function () {
      if (xobj.readyState == 4 && xobj.status == "200") {
        // Required use of an anonymous callback as .open will NOT return a value but simply returns undefined in asynchronous mode
        callback(xobj.responseText);
      }
    };
    xobj.send(null);  
  }
  processTemplates(){
    let that = this;
    this.heroes.forEach(function(el, idx){
      that.heroesTemplates[el.dataset.name] = el.cloneNode(true);
    });
    this.offers.forEach(function(el, idx){
      that.offersTemplates[el.dataset.name] = el.cloneNode(true);
    });
  }
  validateConfig(){
    let that = this;
    let urlParts = this.pathname.split('/');
//     console.log('urlParts', urlParts);
    this.category = urlParts[1];
    this.city = urlParts[2];
    if(typeof this.config[this.category] !== 'undefined' && typeof this.config[this.category][this.city] !== 'undefined'){
      that.mainSpinner.classList.add('d-none');
      this.buildLanding();
    }else{
      if(this.pathname == '/work/basePro.html'){
        this.category = 'deals';
        this.city = 'orlando';
        if(typeof this.config[this.category] === 'undefined'){
          this.category = 'offers';
        }
        that.mainSpinner.classList.add('d-none');
        this.buildLanding();
      }else{
      // TODO add redirect
        alert('Config issue, redirect?');
      }
    }
  }
  buildLanding() {
    let that = this;
    let dataObj = this.config[this.category][this.city];
    let heroTemplate = this.heroesTemplates[dataObj.hero.template];
    let newHero = heroTemplate.cloneNode(true);
    newHero = this.customizeHero(newHero, dataObj.hero, dataObj.definitions.location, dataObj.hero.template);
    that.mainTop.append(newHero);
    let offerTemplate = this.offersTemplates[dataObj.offers.template];
    console.log('dataObj',dataObj)
    let rowEl = document.createElement('div');
    rowEl.className = 'row gx-0 gx-md-2 gx-lg-3 gy-3 main-content-offers ' + dataObj.offers.container_classes;
    that.mainContent.append(rowEl);

    let offersCounter = 0;
    let bannerIdxToUse = 0;
    
    // add basic href to all links available on the page
    document.querySelectorAll('.'+dataObj.offers.action_class).forEach(function(el, idx){
      let search = window.location.search;
      search += '&dslp_pathname='+encodeURI(window.location.pathname);
      let linkStr = that.buildLink(dataObj.offers.action_url, search);
      el.setAttribute('href', linkStr);
    });
    document.querySelectorAll('.j-offer-banner-action').forEach(function(el, idx){
      let search = window.location.search;
      search += '&dslp_pathname='+encodeURI(window.location.pathname);
      let linkStr = that.buildLink(dataObj.offers.action_url, search);
      el.setAttribute('href', linkStr);
    });
    
    dataObj.offers.list.forEach(function(el, idx){
      let newOffer = offerTemplate.cloneNode(true);
      newOffer = that.customizeOffer(newOffer, el, dataObj.offers.template);
      that.addUrlToElement(dataObj.offers.action_url, dataObj.offers.action_class, newOffer, el);
      rowEl.append(newOffer);
      offersCounter++;
      if(offersCounter >= 3 && that.vw <= 767 && typeof dataObj.banners[bannerIdxToUse] != 'undefined'){
        offersCounter = 0;
        let newBanner;
        if(bannerIdxToUse == 0){
          newBanner = that.bannerColumnTemplate.cloneNode(true);
        }else{
          newBanner = that.bannerSideBySideTemplate.cloneNode(true);
        }
        newBanner.querySelector('.j-offer-banner-title').innerHTML = dataObj.banners[bannerIdxToUse].title;
        newBanner.querySelector('.j-offer-banner-action').innerHTML = dataObj.banners[bannerIdxToUse].button;
        newBanner.classList.remove('d-none');
        rowEl.append(newBanner);
//         console.log('qlqqqq')
        bannerIdxToUse++;
//         rowEl = document.createElement('div');
//         rowEl.className = 'row gx-0 gx-md-2 gx-lg-3 gy-3 main-content-offers ' + dataObj.offers.container_classes;
//         that.mainContent.append(rowEl);
      }
    });
    
    document.querySelector('.j-privacy-url').setAttribute('href', dataObj.definitions.privacy_policy_url);
//     console.log('dataObj.offers',dataObj.offers)
//     that.addUrlToElements(dataObj.offers.action_url, dataObj.offers.action_class); // nope
    
    if(typeof this.config.faq.qs !== 'undefined' && this.config.faq.qs.length > 0) { that.customizeFAQ(this.config.faq) }
    
    if(typeof this.config.how_it_works !== 'undefined') { that.customizeHowItWorks(this.config.how_it_works) }
    
    this.templatesContainer.remove();
  }
  customizeHero(hero, data, location, template) {
    if(template == 'banner') {
      hero.querySelector('.j-hero-image').style.backgroundImage = 'url(\''+data.img+'\')';
      hero.querySelector('.j-hero-banner-img').src = data.brand_img;
      hero.querySelector('.j-hero-title').innerHTML = data.title;
      hero.querySelector('.j-hero-subtitle').innerHTML = data.sub_title;
      hero.querySelector('.j-hero-banner-1').innerHTML = location;
      hero.querySelector('.j-hero-banner-2').innerHTML = data.title;
//       hero.querySelector('.j-hero-content').innerHTML = data.content;
      hero.querySelector('.j-hero-action').innerHTML = data.action;
    }else if(template == 'centered') {
      hero.querySelector('.j-hero-image').style.backgroundImage = 'url(\''+data.img+'\')';
      hero.querySelector('.j-hero-title').innerHTML = data.title;
      hero.querySelector('.j-hero-content').innerHTML = data.content;
      hero.querySelector('.j-hero-action').innerHTML = data.action;
    }
    return hero;
  }
  customizeHowItWorks(data, template = null) {
    
    if(typeof data.video_url !== 'undefined') {
      let that = this;
      let newHowItWorksSection = this.templateHowItWorks.cloneNode(true);
      let mainHowItWorksTitle = newHowItWorksSection.querySelector('.template-how-it-works-title');
      let mainHowItWorksText = newHowItWorksSection.querySelector('.template-how-it-works-text');
      let mainHowItWorksVideoContainer = newHowItWorksSection.querySelector('.template-how-it-works-video-container');
      let mainHowItWorksImg = newHowItWorksSection.querySelector('.template-how-it-works-img');
      
      mainHowItWorksTitle.innerText = data.title;
      mainHowItWorksText.innerHTML = data.content;
      
      mainHowItWorksImg.setAttribute('alt', data.title);
      mainHowItWorksImg.setAttribute('src', data.thumbnail_url);
      mainHowItWorksImg.dataset.vid = data.video_url;
      
      this.mainContent.append(newHowItWorksSection);
      
      mainHowItWorksImg.addEventListener("click", function(){
        let video = document.createElement('video');
        video.classList.add('w-100');
        video.classList.add('h-auto');
        video.classList.add('shadow');
        video.poster = data.thumbnail_url;
        video.setAttribute('controls','');
        
        let source = document.createElement('source');
        source.setAttribute('src', data.video_url);
        video.appendChild(source);
        
        mainHowItWorksImg.remove();
        mainHowItWorksVideoContainer.append(video);
        video.play();
        
        video.addEventListener("touchstart", function() {
          this.paused ? this.play() : this.pause();
        }, false);
      }, false);
      
//       mainHowItWorksVideo.poster = data.thumbnail_url;
      
//       let source = document.createElement('source');
//       source.setAttribute('src', data.video_url);
//       mainHowItWorksVideo.appendChild(source);
    }
  }
  customizeFAQ(data, template = null) {
    
    if(data.qs.length) {
      let that = this;
      let newFaqSection = that.templateFaq.cloneNode(true);
      let faqAccordion = newFaqSection.querySelector('#faq-accordion');
      
      
      data.qs.forEach(function(el, idx){
        let newFaqItem = that.faqItemTemplate.cloneNode(true);
        newFaqItem.removeAttribute('id');

        const qid = 'q'+(idx+1);
        const aid = 'a'+(idx+1);

        newFaqItem.querySelector('.j-accordion-header').id = qid;
        newFaqItem.querySelector('.j-faq-accordion-question').innerText = el.q;
        newFaqItem.querySelector('.j-faq-accordion-question').dataset.bsTarget = '#'+aid;
        newFaqItem.querySelector('.j-faq-accordion-question').setAttribute('aria-controls', aid);

        newFaqItem.querySelector('.j-faq-accordion-body').innerText = el.a;
        newFaqItem.querySelector('.j-faq-accordion-collapse').id = aid;
        newFaqItem.querySelector('.j-faq-accordion-collapse').setAttribute('aria-labelledby', qid);
        faqAccordion.append(newFaqItem);
      });
      if(typeof data.action_title !== 'undefined') {
        let faqActionContent = `<h2 class="accordion-header j-accordion-header" id="">
                                <a target="_blank" href="${data.action_url}" >${data.action_title}</a>
                              </h2>`;
        let faqActionElement = document.createElement('div');
        faqActionElement.classList.add('accordion-item');
        faqActionElement.classList.add('accordion-action');
        faqActionElement.innerHTML = faqActionContent;
        
        
        faqAccordion.append(faqActionElement);
      }
      
      that.mainContent.append(newFaqSection);
    }
  }
  customizeOffer(offer, data, template) {
//     console.log('offer', offer);
    let that = this;
    if(template == 'blog') {
      console.log('Missing style configuration');
    }else if(template == 'card') {
      offer.querySelector('.j-offer-image-container').style.backgroundImage = 'url(\''+data.img+'\')';
      offer.querySelector('.j-offer-title').innerHTML = data.title;

      offer.querySelector('.j-offer-content').innerHTML = data.content;
//       offer.querySelector('.j-offer-phone').innerHTML = data.phone;
      offer.querySelector('.j-offer-action').innerHTML = data.action;

      if(typeof data.highlight_box !== 'undefined') {
        let hlbox = offer.querySelector('.j-offer-highlight-section');
        if(typeof data.highlight_box.action_url !== 'undefined') {
          hlbox.setAttribute('href', data.highlight_box.action_url);
        }

        if(typeof data.highlight_box.action_class !== 'undefined') {
          hlbox.classList.add(data.highlight_box.action_class);
        }

        offer.querySelector('.j-offer-hl-1').innerHTML = data.highlight_box.line1;
        offer.querySelector('.j-offer-hl-2').innerHTML = data.highlight_box.line2;
        offer.querySelector('.j-offer-hl-3').innerHTML = data.highlight_box.line3;

        hlbox.classList.remove('d-none');

      }
    }
    return offer;
  }
  buildLink(url, search) {
    if(!search.length) { return url;}
    let arr = url.split('?');
    if (arr.length > 1) {
      search = search.substring(1);
      return url + '&' + search;
    }
    return url + search;
  }
  addUrlToElement(url, selectorClass, element, data){
    let that = this;
    let search = window.location.search;
    // add additional property specific parameters
//     console.log('data',data);
    search += '&dslp_pathname='+encodeURI(window.location.pathname);
    if(typeof data.property_details.propType !== 'undefined'){
      search += '&dslp_propertyType='+data.property_details.propType;
    }
    if(typeof data.property_details.propId !== 'undefined'){
      search += '&dslp_propertyId='+data.property_details.propId;
    }
    let linkStr = that.buildLink(url, search);
    element.querySelectorAll('.'+selectorClass).forEach(function(item) {
      item.setAttribute('href', linkStr);
    });
  }
  addUrlToElements(url, elementsClass){
    return false;
    let that = this;
    let search = window.location.search;
    let linkStr = that.buildLink(url, search);
    document.querySelectorAll('.'+elementsClass).forEach(function(item) {
      item.setAttribute('href', linkStr);
    });
  }
  initComplete(){
    let that = this;
    if (document.cookie.indexOf('acceptedcookies') == -1 ) {
      console.log('cookie doesnt exists');
      document.querySelector('.section-cookies-toast').classList.remove('d-none');
    }
    that.initEventListeners();
    
    let handleScrollBottom = function() {
        var totalPageHeight = document.body.scrollHeight; 
        totalPageHeight = totalPageHeight * 0.8;
        
        var scrollPoint = window.scrollY + window.innerHeight;
//         console.log('scroll point', scrollPoint);
        
        if(scrollPoint >= totalPageHeight){
          fbq('track', 'Scrolled80');
          console.log("FB Scrolled at least 80% of the page");
          window.removeEventListener('scroll', handleScrollBottom);
        }
      };
      window.addEventListener('scroll', handleScrollBottom);
  }
  initEventListeners() {
    let that = this;
    document.getElementById('btn-section-cookies-toast').addEventListener("click", function(){
      that.createCookie('acceptedcookies', 1, 30);
      document.querySelector('.section-cookies-toast').remove();
    }, false);
    
  }
  createCookie(name, value, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
    document.cookie = name + "=" + value + expires + "; path=/";
  }
}

let app = new Builder();
