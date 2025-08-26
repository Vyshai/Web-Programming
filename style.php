body {
    font-family: Arial, sans-serif;
    background-color: whitesmoke;
    margin: 40px;
}

h3 {
    text-align: center;
    font-family: Verdana, sans-serif;
    color: #1a7926;
    margin-bottom: 20px;
}

.custom-table {
    width: 80%;
    margin: 0 auto;
    border-collapse: collapse;
    font-size: 16px;
    box-shadow: 0 4px 8px rgba(10, 75, 19, 0.15);
    border-radius: 8px;
    overflow: hidden;
}
.custom-table th {
    background-color: #ecd053;
    color: #6d6875;
    text-align: left;
    padding: 12px;
}
.custom-table td {
    padding: 12px;
    border-bottom: 1px solid #e2d6f9;
}
.custom-table tr:nth-child(even) {
    background-color: #f9f7f3; 
}

.custom-table tr:nth-child(odd) {
    background-color: #e2d6f9; 
}

.custom-table tr:hover {
    background-color: #ffe5ec; 
    transition: 0.3s;
}
.low-stock {
    background-color: #fff1e6 !important;
    color: #ee9c9c; 
    font-weight: bold;
}
.in-stock {
    background-color: #e0f7fa !important;
    color: #00796b; 
    font-weight: bold;
}
.out-of-stock {
    background-color: #ffebee !important;
    color: #c62828; 
    font-weight: bold;
}
.custom-table th, .custom-table td {
    border-right: 1px solid #e2d6f9;
}
.custom-table th:last-child, .custom-table td:last-child {
    border-right: none;
}
.custom-table th {
    border-bottom: 2px solid #e2d6f9;
}
