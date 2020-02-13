<script>
    let url = window.location.search;
    let regexpImg = new RegExp('\\?paramimg=(.*)&');
    let foundImg = regexpImg.exec(url)[1];
    let regexpMsg = new RegExp('\&msg=(.*)');
    let foundMsg = regexpMsg.exec(url)[1];
    let decodedMessage = atob(foundMsg);
    let customer = document.title.split(" - ")[1];
    document.body.style.background = "url('files/" + customer + "/" + foundImg + ".jpg') no-repeat top left/cover fixed";

    let messageDiv = document.createElement('div');
    messageDiv.classList.add('message');
    messageDiv.classList.add('ce_text');
    let signature = document.querySelector('.card-signature');
    if(signature !== null) {
      document.getElementById('show-msg-article').insertBefore(messageDiv, signature);
    } else {
        document.getElementById('show-msg-article').insertAdjacentElement("beforeend", messageDiv);
    }
    let text = document.createTextNode(decodedMessage);
    messageDiv.innerHTML = text.nodeValue.replace(/\n/g, '<br>\n');

    window.onload = function(){
        let canvas = document.getElementById("content");
        let ctx = canvas.getContext("2d");
        let W = window.innerWidth;
        let H = window.innerHeight;
        canvas.width = W;
        canvas.height = H;
        let mp = 2020;
        let particles = [];
        for(let i = 0; i < mp; i++)
        {
            particles.push({
                x: Math.random()*W,
                y: Math.random()*H,
                r: Math.random()*2+1,
                d: Math.random()*mp
            })
        }
        function draw()
        {
            ctx.clearRect(0, 0, W, H);
            ctx.fillStyle = "rgba(255, 255, 255, 0.8)";
            ctx.beginPath();
            for(let i = 0; i < mp; i++)
            {
                let p = particles[i];
                ctx.moveTo(p.x, p.y);
                ctx.arc(p.x, p.y, p.r, 0, Math.PI*7, true);
            }
            ctx.fill();
            update();
        }
        let angle = 0;
        function update()
        {
            angle += 0.01;
            for(let i = 0; i < mp; i++)
            {
                let p = particles[i];
                p.y += Math.cos(angle+p.d) + 1 + p.r/2;
                p.x += Math.sin(angle) * 2;
                if(p.x > W+5 || p.x < -5 || p.y > H)
                {
                    if(i%3 > 0)
                    {
                        particles[i] = {x: Math.random()*W, y: -10, r: p.r, d: p.d};
                    }
                    else
                    {
                        if(Math.sin(angle) > 0)
                        {
                            particles[i] = {x: -5, y: Math.random()*H, r: p.r, d: p.d};
                        }
                        else
                        {
                            particles[i] = {x: W+5, y: Math.random()*H, r: p.r, d: p.d};
                        }
                    }
                }
            }
        }
        setInterval(draw, 35);
    };
</script>