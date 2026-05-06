// Click Event Handler
let clickCount = 0;
function handleClick() {
    clickCount++;
    const output = document.getElementById('clickOutput');
    output.innerHTML = `Button clicked ${clickCount} time(s)! 🎉`;
    output.style.display = 'block';
}

// Double Click Event Handler
function handleDoubleClick(element) {
    const output = document.getElementById('dblClickOutput');
    element.style.background = 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)';
    element.style.transform = 'scale(1.1)';
    output.innerHTML = 'Double-click detected! Box transformed! 🎨';
    output.style.display = 'block';
    
    setTimeout(() => {
        element.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
        element.style.transform = 'scale(1)';
    }, 1000);
}

// Mouse Enter Event Handler
function handleMouseEnter(element) {
    element.style.transform = 'translateY(-10px) scale(1.05)';
    element.style.boxShadow = '0 15px 40px rgba(102, 126, 234, 0.4)';
    const details = element.querySelector('p');
    details.textContent = 'Price: ₹25,000 | In Stock ✓';
}

// Mouse Leave Event Handler
function handleMouseLeave(element) {
    element.style.transform = 'translateY(0) scale(1)';
    element.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.1)';
    const details = element.querySelector('p');
    details.textContent = 'Hover to see details';
}

// Keyboard Event Handlers
function handleKeyDown(event) {
    const output = document.getElementById('keyboardOutput');
    output.innerHTML = `Key Down: "${event.key}" (Code: ${event.keyCode})`;
    output.style.display = 'block';
}

function handleKeyUp(event) {
    const output = document.getElementById('keyboardOutput');
    const value = event.target.value;
    output.innerHTML = `Key Up: "${event.key}" | Current Text: "${value}" | Length: ${value.length}`;
}

// Focus Event Handler
function handleFocus(element) {
    element.style.borderColor = '#667eea';
    element.style.boxShadow = '0 0 10px rgba(102, 126, 234, 0.5)';
    const output = document.getElementById('formOutput');
    output.innerHTML = 'Input field focused! 🎯';
    output.style.display = 'block';
}

// Blur Event Handler
function handleBlur(element) {
    element.style.borderColor = '#ddd';
    element.style.boxShadow = 'none';
    const output = document.getElementById('formOutput');
    output.innerHTML = 'Input field lost focus! 👋';
}

// Change Event Handler
function handleChange(element) {
    const output = document.getElementById('formOutput');
    output.innerHTML = `Value changed to: "${element.value}" ✏️`;
}

// Form Submit Event Handler
function handleFormSubmit(event) {
    event.preventDefault();
    const input = event.target.querySelector('input');
    const output = document.getElementById('formOutput');
    
    if (input.value.trim() === '') {
        output.innerHTML = '❌ Please enter a name!';
        output.style.color = '#dc3545';
    } else {
        output.innerHTML = `✅ Form submitted! Welcome, ${input.value}!`;
        output.style.color = '#28a745';
        input.value = '';
    }
    output.style.display = 'block';
}

// Dropdown Change Event Handler
function handleCategoryChange(select) {
    const output = document.getElementById('categoryOutput');
    const value = select.value;
    
    if (value === '') {
        output.style.display = 'none';
        return;
    }
    
    const categories = {
        laptops: { name: 'Laptops', count: 25, icon: '💻' },
        phones: { name: 'Smartphones', count: 40, icon: '📱' },
        headphones: { name: 'Headphones', count: 30, icon: '🎧' },
        cameras: { name: 'Cameras', count: 15, icon: '📷' }
    };
    
    const category = categories[value];
    output.innerHTML = `
        ${category.icon} Selected: <strong>${category.name}</strong><br>
        Available Products: ${category.count}
    `;
    output.style.display = 'block';
}

// Context Menu Event Handler
function handleContextMenu(event) {
    event.preventDefault();
    const output = document.getElementById('contextOutput');
    output.innerHTML = `Right-click detected at position (${event.clientX}, ${event.clientY})! 🖱️`;
    output.style.display = 'block';
}

// Image Load Event Handler
function loadImage() {
    const container = document.getElementById('imageContainer');
    const output = document.getElementById('loadOutput');
    
    output.innerHTML = 'Loading image... ⏳';
    output.style.display = 'block';
    
    // Create a placeholder colored box instead of actual image
    const placeholder = document.createElement('div');
    placeholder.style.width = '200px';
    placeholder.style.height = '200px';
    placeholder.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
    placeholder.style.borderRadius = '15px';
    placeholder.style.display = 'flex';
    placeholder.style.alignItems = 'center';
    placeholder.style.justifyContent = 'center';
    placeholder.style.color = 'white';
    placeholder.style.fontSize = '60px';
    placeholder.style.marginTop = '15px';
    placeholder.textContent = '🖼️';
    
    // Simulate loading delay
    setTimeout(() => {
        container.innerHTML = '';
        container.appendChild(placeholder);
        output.innerHTML = '✅ Image loaded successfully!';
        output.style.color = '#28a745';
    }, 1000);
}

// Navigation Highlight Handlers
function highlightNav(element) {
    element.style.background = '#667eea';
    element.style.transform = 'translateY(-2px)';
}

function unhighlightNav(element) {
    element.style.background = 'transparent';
    element.style.transform = 'translateY(0)';
}

// Window Load Event
window.addEventListener('load', function() {
    console.log('Page fully loaded! All event handlers are ready.');
});

// Window Resize Event
window.addEventListener('resize', function() {
    console.log(`Window resized to: ${window.innerWidth}x${window.innerHeight}`);
});

// Scroll Event
window.addEventListener('scroll', function() {
    const scrollPosition = window.scrollY;
    if (scrollPosition > 100) {
        document.querySelector('nav').style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.2)';
    } else {
        document.querySelector('nav').style.boxShadow = 'none';
    }
});
