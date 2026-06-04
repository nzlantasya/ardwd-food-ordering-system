<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Around D' World - Global Fine Dining</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #800000; --accent: #d4af37; --bg: #0a0a0a; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: var(--bg); color: white; overflow-x: hidden; }
        
        /* Header & Hero */
        header { background: rgba(0,0,0,0.8); padding: 1rem 5%; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 100; backdrop-filter: blur(10px); border-bottom: 1px solid var(--accent); }
        .hero { height: 60vh; background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; }
        
        /* Menu Grid */
        .container { max-width: 1200px; margin: 50px auto; padding: 0 20px; }
        .section-title { color: var(--accent); text-align: center; margin-bottom: 40px; font-size: 2.5rem; }
        .menu-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; }
        
        .card { background: rgba(255,255,255,0.05); border-radius: 15px; overflow: hidden; transition: 0.4s; border: 1px solid rgba(255,255,255,0.1); }
        .card:hover { transform: translateY(-10px); border-color: var(--accent); }
        .card img { width: 100%; height: 200px; object-fit: cover; }
        .card-info { padding: 20px; }
        .card-info h3 { color: var(--accent); margin-bottom: 10px; }
        .btn-add { background: var(--accent); color: black; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; font-weight: 600; width: 100%; }

        /* Floating Cart Icon */
        .cart-float { position: fixed; bottom: 30px; right: 30px; background: var(--accent); color: black; padding: 20px; border-radius: 50%; cursor: pointer; box-shadow: 0 5px 15px rgba(0,0,0,0.3); z-index: 99; }
    </style>
</head>
<body>

<header>
    <div style="font-size: 1.5rem; font-weight: 600; color: var(--accent);">AROUND <span style="color:white">D' WORLD</span></div>
    <div style="cursor:pointer" onclick="goToCheckout()"><i class="fas fa-shopping-cart"></i> <span id="count">0</span></div>
</header>

<section class="hero">
    <h1>Global Symphony of Flavors</h1>
    <p>Experience world-class cuisine from the comfort of your seat.</p>
</section>

<div class="container">
    <h2 class="section-title">Signature Mains</h2>
    <div class="menu-grid" id="mains"></div>
    
    <h2 class="section-title" style="margin-top: 60px;">Refreshing Drinks</h2>
    <div class="menu-grid" id="drinks"></div>
</div>

<div class="cart-float" onclick="goToCheckout()">
    <i class="fas fa-paper-plane"></i>
</div>

<script>
    const mains = [
        { name: "Beef Rendang", price: 95000, img: "https://images.unsplash.com/photo-1626074353765-517a681e40be?w=400" },
        { name: "Hokkaido Ramen", price: 120000, img: "https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=400" },
        { name: "Istanbul Kebab", price: 85000, img: "https://images.unsplash.com/photo-1529006557810-274b9b2fc783?w=400" },
        { name: "Wagyu Steak", price: 450000, img: "https://images.unsplash.com/photo-1546241072-48010ad2862c?w=400" },
        { name: "Italian Pizza", price: 110000, img: "https://images.unsplash.com/photo-1513104890138-7c749659a591?w=400" },
        { name: "Sushi Platter", price: 150000, img: "https://images.unsplash.com/photo-1579871494447-9811cf80d66c?w=400" },
        { name: "Thai Tom Yum", price: 75000, img: "https://images.unsplash.com/photo-1548943487-a2e4e43b4853?w=400" },
        { name: "French Croissant", price: 45000, img: "https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=400" },
        { name: "Indian Curry", price: 80000, img: "https://images.unsplash.com/photo-1585937421612-70a008356fbe?w=400" },
        { name: "Spanish Paella", price: 130000, img: "https://images.unsplash.com/photo-1534080564607-c927542245a7?w=400" }
    ];

    const drinks = [
        { name: "Iced Tea", price: 15000, img: "https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=400" },
        { name: "Orange Juice", price: 20000, img: "https://images.unsplash.com/photo-1621506289937-a8e4df240d0b?w=400" },
        { name: "Lemonade", price: 25000, img: "https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=400" },
        { name: "Mineral Water", price: 10000, img: "https://images.unsplash.com/photo-1564419320461-6870880221ad?w=400" },
        { name: "Hot Coffee", price: 30000, img: "https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=400" }
    ];

    let cart = [];

    function render(data, id) {
        document.getElementById(id).innerHTML = data.map(item => `
            <div class="card">
                <img src="${item.img}" alt="${item.name}">
                <div class="card-info">
                    <h3>${item.name}</h3>
                    <p style="margin-bottom:15px">Rp ${item.price.toLocaleString()}</p>
                    <button class="btn-add" onclick="addToCart('${item.name}', ${item.price})">Add to Order</button>
                </div>
            </div>
        `).join('');
    }

    function addToCart(name, price) {
        cart.push({name, price});
        document.getElementById('count').innerText = cart.length;
    }

    function goToCheckout() {
        if(cart.length === 0) return alert("Please select a menu first!");
        // Kirim data ke checkout.php menggunakan localStorage agar rapi
        localStorage.setItem('tempOrder', JSON.stringify(cart));
        window.location.href = 'checkout.php';
    }

    window.onload = () => { render(mains, 'mains'); render(drinks, 'drinks'); };
</script>
</body>
</html>
