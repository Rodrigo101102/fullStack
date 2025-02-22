import React, { useEffect, useState } from "react";
import "../css/producto.css"; 

const Producto = () => {
    const [productos, setProductos] = useState([]);
    const [carrito, setCarrito] = useState({});
    const [cantidades, setCantidades] = useState({});
    const [productoSeleccionado, setProductoSeleccionado] = useState(null);
    const [productoAñadido, setProductoAñadido] = useState(null);

    useEffect(() => {
        console.log("Productos recibidos en React:", window.products);
        setProductos(window.products || []);

        const carritoGuardado = JSON.parse(localStorage.getItem("carrito")) || {};
        setCarrito(carritoGuardado);
    }, []);

    const cambiarCantidad = (id, cantidad) => {
        setCantidades((prev) => ({
            ...prev,
            [id]: Math.max(1, (prev[id] || 1) + cantidad),
        }));
    };

    const agregarAlCarrito = (producto) => {
        const nuevaCantidad = cantidades[producto.id] || 1;
        const nuevoCarrito = {
            ...carrito,
            [producto.id]: {
                ...producto,
                cantidad: (carrito[producto.id]?.cantidad || 0) + nuevaCantidad,
            },
        };

        setCarrito(nuevoCarrito);
        localStorage.setItem("carrito", JSON.stringify(nuevoCarrito));

        setProductoAñadido({ nombre: producto.nombre, cantidad: nuevaCantidad });

        // Reset cantidad a 1
        setCantidades((prev) => ({
            ...prev,
            [producto.id]: 1,
        }));

        // Eliminar la notificación después de 3 segundos
        setTimeout(() => setProductoAñadido(null), 3000);
    };

    const abrirModalDetalles = (producto) => {
        setProductoSeleccionado(producto);
    };

    const cerrarModal = () => {
        setProductoSeleccionado(null);
    };

    return (
        <div className="productos-container">
            <h2>Nuestros Productos</h2>

            {productoAñadido && (
                <div className="notificacion-carrito">
                    <p>✅ {productoAñadido.nombre} ({productoAñadido.cantidad} unidades) añadido al carrito</p>
                </div>
            )}

            <div className="productos-grid">
                {productos.length > 0 ? (
                    productos.map((producto) => (
                        <div className="producto-card" key={producto.id}>
                            <img 
                                src={`http://127.0.0.1:8000/${producto.imagen}`} 
                                alt={producto.nombre} 
                                className="producto-img"
                            />
                            <div className="producto-info">
                                <h3>{producto.nombre}</h3>
                                <p className="producto-precio">S/. {producto.precio}</p>
                                <button className="btn-detalles" onClick={() => abrirModalDetalles(producto)}>
                                    Ver más detalles
                                </button>
                                <div className="cantidad-control">
                                    <button onClick={() => cambiarCantidad(producto.id, -1)}>-</button>
                                    <span>{cantidades[producto.id] || 1}</span>
                                    <button onClick={() => cambiarCantidad(producto.id, 1)}>+</button>
                                </div>
                                <button className="btn-comprar" onClick={() => agregarAlCarrito(producto)}>
                                    Agregar al carrito
                                </button>
                            </div>
                        </div>
                    ))
                ) : (
                    <p>No hay productos disponibles.</p>
                )}
            </div>

            {productoSeleccionado && (
                <div className="modal">
                    <div className="modal-content">
                        <h3 className="modal-header">{productoSeleccionado.nombre}</h3>
                        <img 
                            src={`http://127.0.0.1:8000/${productoSeleccionado.imagen}`} 
                            alt={productoSeleccionado.nombre} 
                            className="modal-img"
                        />
                        <div className="modal-body">
                            <p><strong>Precio:</strong> S/. {productoSeleccionado.precio}</p>
                            <p><strong>Color:</strong> {productoSeleccionado.color}</p>
                            <p><strong>Stock:</strong> {productoSeleccionado.stock} unidades</p>
                        </div>
                        <button className="btn-cerrar" onClick={cerrarModal}>Cerrar</button>
                    </div>
                </div>
            )}
        </div>
    );
};

export default Producto;
