<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review Your Order - Around D' World</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root { --accent: #d4af37; --bg: #0a0a0a; }
        body { background: var(--bg); color: white; font-family: 'Poppins', sans-serif; display: flex; justify-content: center; padding: 50px 20px; }
        .checkout-box { background: rgba(255,255,255,0.05); padding: 40px; border-radius: 20px; border: 1px solid var(--accent); width: 100%; max-width: 600px; }
        h2 { color: var(--accent); text-align: center; }
        
        .order-item { 
            display: flex; justify-content: space-between; align-items: center; 
            padding: 10px 0; border-bottom: 1px solid #333; margin-bottom: 10px;
        }
        .btn-remove { color: #ff4444; cursor: pointer; font-size: 0.8rem; border: 1px solid #ff4444; padding: 2px 8px; border-radius: 4px; }
        .btn-remove:hover { background: #ff4444; color: white; }
        
        .total-section { margin: 20px 0; padding-top: 10px; border-top: 2px solid var(--accent); font-weight: 600; font-size: 1.2rem; display: flex; justify-content: space-between; }
        
        input, textarea { width: 100%; padding: 12px; margin-bottom: 15px; background: #1a1a1a; border: 1px solid #444; color: white; border-radius: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 15px; background: var(--accent); border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.3s; }
        button:hover { opacity: 0.8; transform: translateY(-2px); }
        .back-link { display: block; text-align: center; margin-top: 15px; color: #888; text-decoration: none; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="checkout-box">
        <h2>Your Order Summary</h2>
        <p style="text-align:center; font-size: 0.9rem; color: #aaa;">Review your items before checking out</p>
        
        <div id="orderList"></div>
        
        <div class="total-section">
            <span>Total Amount</span>
            <span id="totalPrice">Rp 0</span>
        </div>
        
        <form action="proses_pesan.php" method="POST" id="orderForm">
            <input type="hidden" name="food_item" id="hiddenItems">
            
            <label style="color:var(--accent); font-size: 0.8rem;">FULL NAME</label>
            <input type="text" name="customer_name" placeholder="Required" required>
            
            <label style="color:var(--accent); font-size: 0.8rem;">WHATSAPP NUMBER</label>
            <input type="tel" name="phone_number" placeholder="Required" required>
            
            <label style="color:var(--accent); font-size: 0.8rem;">SHIPPING ADDRESS</label>
            <textarea name="address" rows="3" placeholder="Required" required></textarea>
            
            <button type="submit">Confirm & Place Order</button>
            <a href="index.php" class="back-link">Add more items</a>
        </form>
    </div>

    <script>
        let cart = JSON.parse(localStorage.getItem('tempOrder')) || [];

        function renderOrder() {
            const listDiv = document.getElementById('orderList');
            const totalDiv = document.getElementById('totalPrice');
            const hiddenInput = document.getElementById('hiddenItems');

            if(cart.length === 0) {
                listDiv.innerHTML = "<p style='text-align:center'>Your cart is empty.</p>";
                totalDiv.innerText = "Rp 0";
                return;
            }

            listDiv.innerHTML = cart.map((item, index) => `
                <div class="order-item">
                    <span>${item.name}</span>
                    <div>
                        <span style="margin-right:15px">Rp ${item.price.toLocaleString()}</span>
                        <span class="btn-remove" onclick="removeItem(${index})">Remove</span>
                    </div>
                </div>
            `).join('');

            const total = cart.reduce((sum, item) => sum + item.price, 0);
            totalDiv.innerText = `Rp ${total.toLocaleString()}`;
            hiddenInput.value = cart.map(i => i.name).join(', ');
        }

        function removeItem(index) {
            cart.splice(index, 1);
            localStorage.setItem('tempOrder', JSON.stringify(cart));
            renderOrder();
        }

        renderOrder();
    </script>
</body>
</html>
