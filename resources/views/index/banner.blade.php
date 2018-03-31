
<style>
  body {
    overflow-x:hidden;  
  }

  .v-header {
    height: 100vh;
    display: flex;
    align-items: center;
    color: #fff;
  }

  .v-container {
    max-width: 960px;
    padding-left:1rem;
    padding-right:1rem;
    margin:auto;
    text-align:center;
  }

  .fullscreen-video-wrap {
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100vh;
    overflow: hidden;
  }

  .fullscreen-video-wrap video {
    min-width:100%;
    min-height:100%;
  }

  .header-overlay {
    height:100vh;
    width:100vw;
    position:absolute;
    top:0;
    left:0;
    background: grey;
    z-index:1;
    opacity:0.85;
  }

  .header-content {
    z-index:2;
  }

  .header-content h1 {
    font-size: 50px;
    margin-bottom: 0;
  }

  .header-content p {
    font-size:1.5rem;
    display: block;
    padding-bottom: 2rem;
  }

  .v-btn {
    background: blue;
    color: #fffff;
    font-size:1.2rem;
    padding: 1rem 2rem;
    text-decoration: none;
  }

  @media(max-width:960px){
    .v-container {
      padding-right: 3rem;
      padding-left: 3rem;
    }
  }

</style>

<header class="v-header v-container">
  <div class="fullscreen-video-wrap">
    <video src="images/banner-vdo.mov" autoplay="true" loop="true"></video>
  </div>
  <div class="header-overlay"></div>
  <div class="header-content">
    <h1>    “การศึกษาเป็นอาวุธที่ทรงพลังที่สุด ที่เราจะนำมาใช้ในการเปลี่ยนแปลงโลก.”
        </h1>
    <p>
    -เนลสัน แมนเดลา - (อดีตประธานาธิปดีผู้ยิ่งใหญ่ของแอฟริกาใต้)
    </p>
    <a href="/search" class="btn">ค้นหาคอร์สเรียน</a>
  </div>
</header>