const { createApp } = Vue;

createApp({
  data() {
    return {
      blogs: [
        {
          title: 'NASA Houston',
          subTitle: 'Rocket is so cool!',
          img: './src/img/background1.jpg',
          link: './blog_nasa.html',
        },
        {
          title: 'South Korea',
          subTitle: 'Women\'s shopping paradise',
          img: './src/img/background2.jpg',
          link: './blog_korea.html',
        },
        {
          title: 'Germany',
          subTitle: 'Amazing industrial country in the world',
          img: './src/img/background5.jpg',
          link: './blog_germany.html',
        },
        {
          title: 'Japan',
          subTitle: 'A country with abundant cultural assets',
          img: './src/img/background4.jpg',
          link: './blog_japan.html',
        },
        {
          title: 'Denmark',
          subTitle: 'Castles are huge.',
          img: './src/img/background3.jpg',
          link: './blog_denmark.html',
        },
      ],
    };
  },
}).mount('#app');
