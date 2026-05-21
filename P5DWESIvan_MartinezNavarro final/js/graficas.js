import * as d3 from 'https://cdn.jsdelivr.net/npm/d3@7/+esm';

const svg = d3.select('#familiaIMC');

async function graficaFamiliaIMC() {
  try {

    
    const response = await fetch('./index.php/home/familiaImc/2344');
    const data = await response.json();

    const W = 700, H = 400;
    const M = { top: 40, right: 20, bottom: 120, left: 60 };
    const iw = W - M.left - M.right;
    const ih = H - M.top - M.bottom;

    svg
      .attr('width', W)
      .attr('height', H)
      .attr('viewBox', [0, 0, W, H])
      .attr('style', 'max-width: 100%; height: auto;');

    const x = d3.scaleBand()
      .domain(data.map(d => d.familia_profesional))
      .range([M.left, W - M.right])
      .padding(0.3);

    const y = d3.scaleLinear()
      .domain([0, d3.max(data, d => +d.imc_promedio) * 1.2])
      .range([H - M.bottom, M.top]);

    // Grid horizontal
    svg.append('g')
      .attr('transform', `translate(${M.left}, 0)`)
      .call(d3.axisLeft(y).ticks(5).tickSize(-(iw)).tickFormat(''))
      .call(ax => ax.select('.domain').remove())
      .call(ax => ax.selectAll('.tick line').attr('stroke', 'rgba(0,0,0,0.07)'));

    // Barras
    svg.selectAll('rect')
      .data(data)
      .join('rect')
      .attr('x',      d => x(d.familia_profesional))
      .attr('width',  x.bandwidth())
      .attr('y',      d => y(+d.imc_promedio))
      .attr('height', d => H - M.bottom - y(+d.imc_promedio))
      .attr('fill',   '#185FA5')
      .attr('rx',     4);

    // Etiquetas encima de cada barra
    svg.selectAll('.label')
      .data(data)
      .join('text')
      .attr('class', 'label')
      .attr('x', d => x(d.familia_profesional) + x.bandwidth() / 2)
      .attr('y', d => y(+d.imc_promedio) - 6)
      .attr('text-anchor', 'middle')
      .attr('font-size', '12px')
      .attr('fill', '#185FA5')
      .text(d => (+d.imc_promedio).toFixed(1));

    // Eje X
    svg.append('g')
      .attr('transform', `translate(0, ${H - M.bottom})`)
      .call(d3.axisBottom(x).tickSize(0))
      .call(ax => ax.select('.domain').attr('stroke', 'rgba(0,0,0,0.15)'))
      .selectAll('text')
      .attr('font-size', '12px')
      .attr('fill', '#888780')
      .attr('transform', 'rotate(-30)')
      .attr('text-anchor', 'end');

    // Eje Y
    svg.append('g')
  .attr('transform', `translate(${M.left}, 0)`)
  .call(d3.axisLeft(y).ticks(5).tickSize(-iw).tickFormat(''))
  .call(ax => ax.select('.domain').remove())
  .call(ax => ax.selectAll('.tick line')
    .attr('stroke', 'rgba(0,0,0,0.07)')
    .attr('x2', iw));

    // Título
    svg.append('text')
      .attr('x', W / 2).attr('y', 20)
      .attr('text-anchor', 'middle')
      .attr('font-size', '14px')
      .attr('font-weight', '500')
      .attr('fill', '#2c2c2a')
      .text('IMC promedio por familia profesional');

    return svg.node();

  } catch (err) {
    console.error('Error:', err);
  }
}

graficaFamiliaIMC();

const svg2 = d3.select('#sexoIMC');

async function graficaSexoIMC() {
  try {


    const response = await fetch('./index.php/home/sexoImc/2344');
    const data = await response.json();

    const W = 700, H = 400;
    const M = { top: 40, right: 20, bottom: 120, left: 60 };
    const iw = W - M.left - M.right;
    const ih = H - M.top - M.bottom;

    svg2
      .attr('width', W)
      .attr('height', H)
      .attr('viewBox', [0, 0, W, H])
      .attr('style', 'max-width: 100%; height: auto;');

    const x = d3.scaleBand()
      .domain(data.map(d => d.sexo))
      .range([M.left, W - M.right])
      .padding(0.3);

    const y = d3.scaleLinear()
      .domain([0, d3.max(data, d => +d.imc_promedio) * 1.2])
      .range([H - M.bottom, M.top]);

    // Grid horizontal
    svg2.append('g')
      .attr('transform', `translate(${M.left}, 0)`)
      .call(d3.axisLeft(y).ticks(5).tickSize(-(iw)).tickFormat(''))
      .call(ax => ax.select('.domain').remove())
      .call(ax => ax.selectAll('.tick line').attr('stroke', 'rgba(0,0,0,0.07)'));

    // Barras
    svg2.selectAll('rect')
      .data(data)
      .join('rect')
      .attr('x',      d => x(d.sexo))
      .attr('width',  x.bandwidth())
      .attr('y',      d => y(+d.imc_promedio))
      .attr('height', d => H - M.bottom - y(+d.imc_promedio))
      .attr('fill',   '#185FA5')
      .attr('rx',     4);

    // Etiquetas encima de cada barra
    svg2.selectAll('.label')
      .data(data)
      .join('text')
      .attr('class', 'label')
      .attr('x', d => x(d.sexo) + x.bandwidth() / 2)
      .attr('y', d => y(+d.imc_promedio) - 6)
      .attr('text-anchor', 'middle')
      .attr('font-size', '12px')
      .attr('fill', '#185FA5')
      .text(d => (+d.imc_promedio).toFixed(1));

    // Eje X
    svg2.append('g')
      .attr('transform', `translate(0, ${H - M.bottom})`)
      .call(d3.axisBottom(x).tickSize(0))
      .call(ax => ax.select('.domain').attr('stroke', 'rgba(0,0,0,0.15)'))
      .selectAll('text')
      .attr('font-size', '12px')
      .attr('fill', '#888780')
      .attr('transform', 'rotate(-30)')
      .attr('text-anchor', 'end');

    // Eje Y
    svg2.append('g')
  .attr('transform', `translate(${M.left}, 0)`)
  .call(d3.axisLeft(y).ticks(5).tickSize(-iw).tickFormat(''))
  .call(ax => ax.select('.domain').remove())
  .call(ax => ax.selectAll('.tick line')
    .attr('stroke', 'rgba(0,0,0,0.07)')
    .attr('x2', iw));

    // Título
    svg2.append('text')
      .attr('x', W / 2).attr('y', 20)
      .attr('text-anchor', 'middle')
      .attr('font-size', '14px')
      .attr('font-weight', '500')
      .attr('fill', '#2c2c2a')
      .text('IMC promedio por sexo');

    return svg2.node();

  } catch (err) {
    console.error('Error:', err);
  }
}

graficaSexoIMC();

const svg3 = d3.select('#centroIMC');

async function graficaCentroIMC() {
  try {

    const response = await fetch('./index.php/home/centroImc/2344');
    const data = await response.json();

    const W = 700, H = 400;
    const M = { top: 40, right: 20, bottom: 120, left: 60 };
    const iw = W - M.left - M.right;
    const ih = H - M.top - M.bottom;

    svg3
      .attr('width', W)
      .attr('height', H)
      .attr('viewBox', [0, 0, W, H])
      .attr('style', 'max-width: 100%; height: auto;');

    const x = d3.scaleBand()
      .domain(data.map(d => d.centro_educativo))
      .range([M.left, W - M.right])
      .padding(0.3);

    const y = d3.scaleLinear()
      .domain([0, d3.max(data, d => +d.imc_promedio) * 1.2])
      .range([H - M.bottom, M.top]);

    // Grid horizontal
    svg3.append('g')
      .attr('transform', `translate(${M.left}, 0)`)
      .call(d3.axisLeft(y).ticks(5).tickSize(-(iw)).tickFormat(''))
      .call(ax => ax.select('.domain').remove())
      .call(ax => ax.selectAll('.tick line').attr('stroke', 'rgba(0,0,0,0.07)'));

    // Barras
    svg3.selectAll('rect')
      .data(data)
      .join('rect')
      .attr('x',      d => x(d.centro_educativo))
      .attr('width',  x.bandwidth())
      .attr('y',      d => y(+d.imc_promedio))
      .attr('height', d => H - M.bottom - y(+d.imc_promedio))
      .attr('fill',   '#185FA5')
      .attr('rx',     4);

    // Etiquetas encima de cada barra
    svg3.selectAll('.label')
      .data(data)
      .join('text')
      .attr('class', 'label')
      .attr('x', d => x(d.centro_educativo) + x.bandwidth() / 2)
      .attr('y', d => y(+d.imc_promedio) - 6)
      .attr('text-anchor', 'middle')
      .attr('font-size', '12px')
      .attr('fill', '#185FA5')
      .text(d => (+d.imc_promedio).toFixed(1));

    // Eje X
    svg3.append('g')
      .attr('transform', `translate(0, ${H - M.bottom})`)
      .call(d3.axisBottom(x).tickSize(0))
      .call(ax => ax.select('.domain').attr('stroke', 'rgba(0,0,0,0.15)'))
      .selectAll('text')
      .attr('font-size', '12px')
      .attr('fill', '#888780')
      .attr('transform', 'rotate(-30)')
      .attr('text-anchor', 'end');

    // Eje Y
    svg3.append('g')
  .attr('transform', `translate(${M.left}, 0)`)
  .call(d3.axisLeft(y).ticks(5).tickSize(-iw).tickFormat(''))
  .call(ax => ax.select('.domain').remove())
  .call(ax => ax.selectAll('.tick line')
    .attr('stroke', 'rgba(0,0,0,0.07)')
    .attr('x2', iw));

    // Título
    svg3.append('text')
      .attr('x', W / 2).attr('y', 20)
      .attr('text-anchor', 'middle')
      .attr('font-size', '14px')
      .attr('font-weight', '500')
      .attr('fill', '#2c2c2a')
      .text('IMC promedio por centro');

    return svg3.node();

  } catch (err) {
    console.error('Error:', err);
  }
}

graficaCentroIMC();


const svg4 = d3.select('#familiaICA');


async function graficaFamiliaICA() {
  try {


    const response = await fetch('./index.php/home/familiaIca/2344');
    const data = await response.json();

    const W = 700, H = 400;
    const M = { top: 40, right: 20, bottom: 120, left: 60 };
    const iw = W - M.left - M.right;
    const ih = H - M.top - M.bottom;

    svg4
      .attr('width', W)
      .attr('height', H)
      .attr('viewBox', [0, 0, W, H])
      .attr('style', 'max-width: 100%; height: auto;');

    const x = d3.scaleBand()
      .domain(data.map(d => d.familia_profesional))
      .range([M.left, W - M.right])
      .padding(0.3);

    const y = d3.scaleLinear()
      .domain([0, d3.max(data, d => +d.ica_promedio) * 1.2])
      .range([H - M.bottom, M.top]);

    // Grid horizontal
    svg4.append('g')
      .attr('transform', `translate(${M.left}, 0)`)
      .call(d3.axisLeft(y).ticks(5).tickSize(-(iw)).tickFormat(''))
      .call(ax => ax.select('.domain').remove())
      .call(ax => ax.selectAll('.tick line').attr('stroke', 'rgba(0,0,0,0.07)'));

    // Barras
    svg4.selectAll('rect')
      .data(data)
      .join('rect')
      .attr('x',      d => x(d.familia_profesional))
      .attr('width',  x.bandwidth())
      .attr('y',      d => y(+d.ica_promedio))
      .attr('height', d => H - M.bottom - y(+d.ica_promedio))
      .attr('fill',   '#185FA5')
      .attr('rx',     4);

    // Etiquetas encima de cada barra
    svg4.selectAll('.label')
      .data(data)
      .join('text')
      .attr('class', 'label')
      .attr('x', d => x(d.familia_profesional) + x.bandwidth() / 2)
      .attr('y', d => y(+d.ica_promedio) - 6)
      .attr('text-anchor', 'middle')
      .attr('font-size', '12px')
      .attr('fill', '#185FA5')
      .text(d => (+d.ica_promedio).toFixed(1));

    // Eje X
    svg4.append('g')
      .attr('transform', `translate(0, ${H - M.bottom})`)
      .call(d3.axisBottom(x).tickSize(0))
      .call(ax => ax.select('.domain').attr('stroke', 'rgba(0,0,0,0.15)'))
      .selectAll('text')
      .attr('font-size', '12px')
      .attr('fill', '#888780')
      .attr('transform', 'rotate(-30)')
      .attr('text-anchor', 'end');

    // Eje Y
    svg4.append('g')
  .attr('transform', `translate(${M.left}, 0)`)
  .call(d3.axisLeft(y).ticks(5).tickSize(-iw).tickFormat(''))
  .call(ax => ax.select('.domain').remove())
  .call(ax => ax.selectAll('.tick line')
    .attr('stroke', 'rgba(0,0,0,0.07)')
    .attr('x2', iw));

    // Título
    svg4.append('text')
      .attr('x', W / 2).attr('y', 20)
      .attr('text-anchor', 'middle')
      .attr('font-size', '14px')
      .attr('font-weight', '500')
      .attr('fill', '#2c2c2a')
      .text('ICA promedio por familia profesional');

    return svg4.node();

  } catch (err) {
    console.error('Error:', err);
  }
}

graficaFamiliaICA();

const svg5 = d3.select('#centroICA');

async function graficaCentroICA() {
  try {


    const response = await fetch('./index.php/home/centroIca/2344');
    const data = await response.json();

    const W = 700, H = 400;
    const M = { top: 40, right: 20, bottom: 120, left: 60 };
    const iw = W - M.left - M.right;
    const ih = H - M.top - M.bottom;

    svg5
      .attr('width', W)
      .attr('height', H)
      .attr('viewBox', [0, 0, W, H])
      .attr('style', 'max-width: 100%; height: auto;');

    const x = d3.scaleBand()
      .domain(data.map(d => d.centro_educativo))
      .range([M.left, W - M.right])
      .padding(0.3);

    const y = d3.scaleLinear()
      .domain([0, d3.max(data, d => +d.ica_promedio) * 1.2])
      .range([H - M.bottom, M.top]);

    // Grid horizontal
    svg5.append('g')
      .attr('transform', `translate(${M.left}, 0)`)
      .call(d3.axisLeft(y).ticks(5).tickSize(-(iw)).tickFormat(''))
      .call(ax => ax.select('.domain').remove())
      .call(ax => ax.selectAll('.tick line').attr('stroke', 'rgba(0,0,0,0.07)'));

    // Barras
    svg5.selectAll('rect')
      .data(data)
      .join('rect')
      .attr('x',      d => x(d.centro_educativo))
      .attr('width',  x.bandwidth())
      .attr('y',      d => y(+d.ica_promedio))
      .attr('height', d => H - M.bottom - y(+d.ica_promedio))
      .attr('fill',   '#185FA5')
      .attr('rx',     4);

    // Etiquetas encima de cada barra
    svg5.selectAll('.label')
      .data(data)
      .join('text')
      .attr('class', 'label')
      .attr('x', d => x(d.centro_educativo) + x.bandwidth() / 2)
      .attr('y', d => y(+d.ica_promedio) - 6)
      .attr('text-anchor', 'middle')
      .attr('font-size', '12px')
      .attr('fill', '#185FA5')
      .text(d => (+d.ica_promedio).toFixed(1));

    // Eje X
    svg5.append('g')
      .attr('transform', `translate(0, ${H - M.bottom})`)
      .call(d3.axisBottom(x).tickSize(0))
      .call(ax => ax.select('.domain').attr('stroke', 'rgba(0,0,0,0.15)'))
      .selectAll('text')
      .attr('font-size', '12px')
      .attr('fill', '#888780')
      .attr('transform', 'rotate(-30)')
      .attr('text-anchor', 'end');

    // Eje Y
    svg5.append('g')
  .attr('transform', `translate(${M.left}, 0)`)
  .call(d3.axisLeft(y).ticks(5).tickSize(-iw).tickFormat(''))
  .call(ax => ax.select('.domain').remove())
  .call(ax => ax.selectAll('.tick line')
    .attr('stroke', 'rgba(0,0,0,0.07)')
    .attr('x2', iw));

    // Título
    svg5.append('text')
      .attr('x', W / 2).attr('y', 20)
      .attr('text-anchor', 'middle')
      .attr('font-size', '14px')
      .attr('font-weight', '500')
      .attr('fill', '#2c2c2a')
      .text('ICA promedio por centro');

    return svg5.node();

  } catch (err) {
    console.error('Error:', err);
  }
}

graficaCentroICA();


const svg6 = d3.select('#sexoICC');

async function graficaSexoICC() {
  try {

    const response = await fetch('./index.php/home/sexoIcc/2344');
    const data = await response.json();

    const W = 700, H = 400;
    const M = { top: 40, right: 20, bottom: 120, left: 60 };
    const iw = W - M.left - M.right;
    const ih = H - M.top - M.bottom;

    svg6
      .attr('width', W)
      .attr('height', H)
      .attr('viewBox', [0, 0, W, H])
      .attr('style', 'max-width: 100%; height: auto;');

    const x = d3.scaleBand()
      .domain(data.map(d => d.sexo))
      .range([M.left, W - M.right])
      .padding(0.3);

    const y = d3.scaleLinear()
      .domain([0, d3.max(data, d => +d.icc_promedio) * 1.2])
      .range([H - M.bottom, M.top]);

    // Grid horizontal
    svg6.append('g')
      .attr('transform', `translate(${M.left}, 0)`)
      .call(d3.axisLeft(y).ticks(5).tickSize(-(iw)).tickFormat(''))
      .call(ax => ax.select('.domain').remove())
      .call(ax => ax.selectAll('.tick line').attr('stroke', 'rgba(0,0,0,0.07)'));

    // Barras
    svg6.selectAll('rect')
      .data(data)
      .join('rect')
      .attr('x',      d => x(d.sexo))
      .attr('width',  x.bandwidth())
      .attr('y',      d => y(+d.icc_promedio))
      .attr('height', d => H - M.bottom - y(+d.icc_promedio))
      .attr('fill',   '#185FA5')
      .attr('rx',     4);

    // Etiquetas encima de cada barra
    svg6.selectAll('.label')
      .data(data)
      .join('text')
      .attr('class', 'label')
      .attr('x', d => x(d.sexo) + x.bandwidth() / 2)
      .attr('y', d => y(+d.icc_promedio) - 6)
      .attr('text-anchor', 'middle')
      .attr('font-size', '12px')
      .attr('fill', '#185FA5')
      .text(d => (+d.icc_promedio).toFixed(1));

    // Eje X
    svg6.append('g')
      .attr('transform', `translate(0, ${H - M.bottom})`)
      .call(d3.axisBottom(x).tickSize(0))
      .call(ax => ax.select('.domain').attr('stroke', 'rgba(0,0,0,0.15)'))
      .selectAll('text')
      .attr('font-size', '12px')
      .attr('fill', '#888780')
      .attr('transform', 'rotate(-30)')
      .attr('text-anchor', 'end');

    // Eje Y
    svg6.append('g')
  .attr('transform', `translate(${M.left}, 0)`)
  .call(d3.axisLeft(y).ticks(5).tickSize(-iw).tickFormat(''))
  .call(ax => ax.select('.domain').remove())
  .call(ax => ax.selectAll('.tick line')
    .attr('stroke', 'rgba(0,0,0,0.07)')
    .attr('x2', iw));

    // Título
    svg6.append('text')
      .attr('x', W / 2).attr('y', 20)
      .attr('text-anchor', 'middle')
      .attr('font-size', '14px')
      .attr('font-weight', '500')
      .attr('fill', '#2c2c2a')
      .text('ICC promedio por sexo');

    return svg6.node();

  } catch (err) {
    console.error('Error:', err);
  }
}

graficaSexoICC();

const svgNube = d3.select('#familiaIMCP');

async function graficaNubePuntos() {
  try {
    const response = await fetch('./index.php/home/familiaImcp/2344');
    const data = await response.json();
    const dataLimpia = data.filter(d => +d.imc > 10 && +d.imc < 60);

    const W = 700, H = 400;
    const M = { top: 40, right: 20, bottom: 120, left: 60 };
    const iw = W - M.left - M.right;

    svgNube
      .attr('width', W)
      .attr('height', H)
      .attr('viewBox', [0, 0, W, H])
      .attr('style', 'max-width: 100%; height: auto;');

    const familias = [...new Set(dataLimpia.map(d => d.familia_profesional))];
    const colores = d3.scaleOrdinal()
      .domain(familias)
      .range(['#185FA5', '#1D9E75', '#BA7517', '#A32D2D', '#534AB7']);

    const x = d3.scaleBand()
      .domain(familias)
      .range([M.left, W - M.right])
      .padding(0.4);

    const y = d3.scaleLinear()
      .domain([
        Math.floor(d3.min(dataLimpia, d => +d.imc)) - 2,
        Math.ceil(d3.max(dataLimpia, d => +d.imc)) + 2
      ])
      .nice()
      .range([H - M.bottom, M.top]);

    // Grid horizontal
    svgNube.append('g')
      .attr('transform', `translate(${M.left}, 0)`)
      .call(d3.axisLeft(y).ticks(5).tickSize(-iw).tickFormat(''))
      .call(ax => ax.select('.domain').remove())
      .call(ax => ax.selectAll('.tick line')
        .attr('stroke', 'rgba(0,0,0,0.07)')
        .attr('x2', iw));

    // Puntos con jitter
    const jitter = x.bandwidth() * 0.4;
    svgNube.selectAll('circle')
      .data(dataLimpia)
      .join('circle')
      .attr('cx', d => x(d.familia_profesional) + x.bandwidth() / 2 + (Math.random() - 0.5) * jitter)
      .attr('cy', d => y(+d.imc))
      .attr('r', 4)
      .attr('fill', d => colores(d.familia_profesional))
      .attr('opacity', 0.7);

    // Línea de mediana por familia
    familias.forEach(fam => {
      const vals = dataLimpia.filter(d => d.familia_profesional === fam).map(d => +d.imc);
      const mediana = d3.median(vals);
      const cx = x(fam) + x.bandwidth() / 2;
      svgNube.append('line')
        .attr('x1', cx - 20).attr('x2', cx + 20)
        .attr('y1', y(mediana)).attr('y2', y(mediana))
        .attr('stroke', colores(fam))
        .attr('stroke-width', 2.5);
    });

    // Eje X
    svgNube.append('g')
      .attr('transform', `translate(0, ${H - M.bottom})`)
      .call(d3.axisBottom(x).tickSize(0))
      .call(ax => ax.select('.domain').attr('stroke', 'rgba(0,0,0,0.15)'))
      .selectAll('text')
      .attr('font-size', '12px')
      .attr('fill', '#888780')
      .attr('transform', 'rotate(-30)')
      .attr('text-anchor', 'end');

    // Eje Y
    svgNube.append('g')
      .attr('transform', `translate(${M.left}, 0)`)
      .call(d3.axisLeft(y).ticks(5).tickFormat(d => d.toFixed(1)))
      .call(ax => ax.select('.domain').remove())
      .call(ax => ax.selectAll('text').attr('font-size', '11px').attr('fill', '#888780'))
      .call(ax => ax.append('text')
        .attr('x', -M.left)
        .attr('y', 15)
        .attr('fill', 'currentColor')
        .attr('text-anchor', 'start')
        .text('↑ IMC (kg/m²)'));

    // Leyenda
    familias.forEach((fam, i) => {
      svgNube.append('circle')
        .attr('cx', M.left + i * 160)
        .attr('cy', H - 10)
        .attr('r', 5)
        .attr('fill', colores(fam));
      svgNube.append('text')
        .attr('x', M.left + i * 160 + 12)
        .attr('y', H - 6)
        .attr('font-size', '11px')
        .attr('fill', '#888780')
        .text(fam);
    });

    // Título
    svgNube.append('text')
      .attr('x', W / 2).attr('y', 20)
      .attr('text-anchor', 'middle')
      .attr('font-size', '14px')
      .attr('font-weight', '500')
      .attr('fill', '#2c2c2a')
      .text('IMC por familia profesional');

    return svgNube.node();

  } catch (err) {
    console.error('Error:', err);
  }
}

graficaNubePuntos();

const svgGrasa = d3.select('#grasaIMC');

async function graficaGrasaIMC() {
  try {
    const response = await fetch('./index.php/home/grasaImc/2344');
    const data = await response.json();
    const dataLimpia = data.filter(d => +d.imc > 10 && +d.imc < 60 && +d.grasa > 0);

    const W = 700, H = 400;
    const M = { top: 40, right: 20, bottom: 60, left: 60 };
    const iw = W - M.left - M.right;

    svgGrasa
      .attr('width', W)
      .attr('height', H)
      .attr('viewBox', [0, 0, W, H])
      .attr('style', 'max-width: 100%; height: auto;');

    
    const x = d3.scaleLinear()
      .domain([
        Math.floor(d3.min(dataLimpia, d => +d.grasa)) - 1,
        Math.ceil(d3.max(dataLimpia, d => +d.grasa)) + 1
      ])
      .nice()
      .range([M.left, W - M.right]);

    const y = d3.scaleLinear()
      .domain([
        Math.floor(d3.min(dataLimpia, d => +d.imc)) - 2,
        Math.ceil(d3.max(dataLimpia, d => +d.imc)) + 2
      ])
      .nice()
      .range([H - M.bottom, M.top]);

    // Grid horizontal
    svgGrasa.append('g')
      .attr('transform', `translate(${M.left}, 0)`)
      .call(d3.axisLeft(y).ticks(5).tickSize(-iw).tickFormat(''))
      .call(ax => ax.select('.domain').remove())
      .call(ax => ax.selectAll('.tick line').attr('stroke', 'rgba(0,0,0,0.07)'));

    svgGrasa.selectAll('circle')
      .data(dataLimpia)
      .join('circle')
      .attr('cx', d => x(+d.grasa))
      .attr('cy', d => y(+d.imc))
      .attr('r', 4)
      .attr('fill', '#185FA5')
      .attr('opacity', 0.6);

    // Eje X
    svgGrasa.append('g')
      .attr('transform', `translate(0, ${H - M.bottom})`)
      .call(d3.axisBottom(x).ticks(8).tickSize(0))
      .call(ax => ax.select('.domain').attr('stroke', 'rgba(0,0,0,0.15)'))
      .call(ax => ax.selectAll('text').attr('font-size', '11px').attr('fill', '#888780'));

    // Eje Y
    svgGrasa.append('g')
      .attr('transform', `translate(${M.left}, 0)`)
      .call(d3.axisLeft(y).ticks(5).tickFormat(d => d.toFixed(1)))
      .call(ax => ax.select('.domain').remove())
      .call(ax => ax.selectAll('text').attr('font-size', '11px').attr('fill', '#888780'))
      .call(ax => ax.append('text')
        .attr('x', -M.left)
        .attr('y', 15)
        .attr('fill', 'currentColor')
        .attr('text-anchor', 'start')
        .text('↑ IMC (kg/m²)'));

    // Etiqueta eje X
    svgGrasa.append('text')
      .attr('x', M.left + iw / 2)
      .attr('y', H - 10)
      .attr('text-anchor', 'middle')
      .attr('font-size', '11px')
      .attr('fill', '#888780')
      .text('% Grasa corporal');

    // Título
    svgGrasa.append('text')
      .attr('x', W / 2).attr('y', 20)
      .attr('text-anchor', 'middle')
      .attr('font-size', '14px')
      .attr('font-weight', '500')
      .attr('fill', '#2c2c2a')
      .text('IMC por % de grasa corporal');

    return svgGrasa.node();

  } catch (err) {
    console.error('Error:', err);
  }
}

graficaGrasaIMC();

const svgDieta = d3.select('#dietaIMC');

async function graficaDietaIMC() {
  try {
    const response = await fetch('./index.php/home/dietaImc/2344');
    const data = await response.json();
    const dataLimpia = data.filter(d => +d.imc > 10 && +d.imc < 60 && +d.dieta > 0);

    const W = 700, H = 400;
    const M = { top: 40, right: 20, bottom: 60, left: 60 };
    const iw = W - M.left - M.right;

    svgDieta
      .attr('width', W)
      .attr('height', H)
      .attr('viewBox', [0, 0, W, H])
      .attr('style', 'max-width: 100%; height: auto;');

    const x = d3.scaleLinear()
      .domain([
        Math.floor(d3.min(dataLimpia, d => +d.dieta)) - 1,
        Math.ceil(d3.max(dataLimpia, d => +d.dieta)) + 1
      ])
      .nice()
      .range([M.left, W - M.right]);

    const y = d3.scaleLinear()
      .domain([
        Math.floor(d3.min(dataLimpia, d => +d.imc)) - 2,
        Math.ceil(d3.max(dataLimpia, d => +d.imc)) + 2
      ])
      .nice()
      .range([H - M.bottom, M.top]);

    // Grid horizontal
    svgDieta.append('g')
      .attr('transform', `translate(${M.left}, 0)`)
      .call(d3.axisLeft(y).ticks(5).tickSize(-iw).tickFormat(''))
      .call(ax => ax.select('.domain').remove())
      .call(ax => ax.selectAll('.tick line').attr('stroke', 'rgba(0,0,0,0.07)'));

    // Puntos
    svgDieta.selectAll('circle')
      .data(dataLimpia)
      .join('circle')
      .attr('cx', d => x(+d.dieta))
      .attr('cy', d => y(+d.imc))
      .attr('r', 4)
      .attr('fill', '#185FA5')
      .attr('opacity', 0.6);

    // Eje X
    svgDieta.append('g')
      .attr('transform', `translate(0, ${H - M.bottom})`)
      .call(d3.axisBottom(x).ticks(8).tickSize(0))
      .call(ax => ax.select('.domain').attr('stroke', 'rgba(0,0,0,0.15)'))
      .call(ax => ax.selectAll('text').attr('font-size', '11px').attr('fill', '#888780'));

    // Eje Y
    svgDieta.append('g')
      .attr('transform', `translate(${M.left}, 0)`)
      .call(d3.axisLeft(y).ticks(5).tickFormat(d => d.toFixed(1)))
      .call(ax => ax.select('.domain').remove())
      .call(ax => ax.selectAll('text').attr('font-size', '11px').attr('fill', '#888780'))
      .call(ax => ax.append('text')
        .attr('x', -M.left)
        .attr('y', 15)
        .attr('fill', 'currentColor')
        .attr('text-anchor', 'start')
        .text('↑ IMC (kg/m²)'));

    
    svgDieta.append('text')
      .attr('x', M.left + iw / 2)
      .attr('y', H - 10)
      .attr('text-anchor', 'middle')
      .attr('font-size', '11px')
      .attr('fill', '#888780')
      .text('Puntuación adherencia dieta mediterránea');


    svgDieta.append('text')
      .attr('x', W / 2).attr('y', 20)
      .attr('text-anchor', 'middle')
      .attr('font-size', '14px')
      .attr('font-weight', '500')
      .attr('fill', '#2c2c2a')
      .text('IMC por adherencia a la dieta mediterránea');

    return svgDieta.node();

  } catch (err) {
    console.error('Error:', err);
  }
}

graficaDietaIMC();

const svgDieta2 = d3.select('#dietaICA');

async function graficaDietaICA() {
  try {
    const response = await fetch('./index.php/home/dietaIca/2344');
    const data = await response.json();
    const dataLimpia = data.filter(d => +d.ica > 0.3 && +d.ica < 0.8 && +d.dieta > 0);

    const W = 700, H = 400;
    const M = { top: 40, right: 20, bottom: 60, left: 60 };
    const iw = W - M.left - M.right;

    svgDieta2
      .attr('width', W)
      .attr('height', H)
      .attr('viewBox', [0, 0, W, H])
      .attr('style', 'max-width: 100%; height: auto;');

    const x = d3.scaleLinear()
      .domain([
        Math.floor(d3.min(dataLimpia, d => +d.dieta)) - 1,
        Math.ceil(d3.max(dataLimpia, d => +d.dieta)) + 1
      ])
      .nice()
      .range([M.left, W - M.right]);

    const y = d3.scaleLinear()
      .domain([
        Math.floor(d3.min(dataLimpia, d => +d.ica)) - 2,
        Math.ceil(d3.max(dataLimpia, d => +d.ica)) + 2
      ])
      .nice()
      .range([H - M.bottom, M.top]);

    // Grid horizontal
    svgDieta2.append('g')
      .attr('transform', `translate(${M.left}, 0)`)
      .call(d3.axisLeft(y).ticks(5).tickSize(-iw).tickFormat(''))
      .call(ax => ax.select('.domain').remove())
      .call(ax => ax.selectAll('.tick line').attr('stroke', 'rgba(0,0,0,0.07)'));

    // Puntos
    svgDieta2.selectAll('circle')
      .data(dataLimpia)
      .join('circle')
      .attr('cx', d => x(+d.dieta))
      .attr('cy', d => y(+d.ica))
      .attr('r', 4)
      .attr('fill', '#185FA5')
      .attr('opacity', 0.6);

    // Eje X
    svgDieta2.append('g')
      .attr('transform', `translate(0, ${H - M.bottom})`)
      .call(d3.axisBottom(x).ticks(8).tickSize(0))
      .call(ax => ax.select('.domain').attr('stroke', 'rgba(0,0,0,0.15)'))
      .call(ax => ax.selectAll('text').attr('font-size', '11px').attr('fill', '#888780'));

    // Eje Y
    svgDieta2.append('g')
      .attr('transform', `translate(${M.left}, 0)`)
      .call(d3.axisLeft(y).ticks(5).tickFormat(d => d.toFixed(1)))
      .call(ax => ax.select('.domain').remove())
      .call(ax => ax.selectAll('text').attr('font-size', '11px').attr('fill', '#888780'))
      .call(ax => ax.append('text')
        .attr('x', -M.left)
        .attr('y', 15)
        .attr('fill', 'currentColor')
        .attr('text-anchor', 'start')
        .text('↑ ICA (cintura/altura)'));

    
    svgDieta2.append('text')
      .attr('x', M.left + iw / 2)
      .attr('y', H - 10)
      .attr('text-anchor', 'middle')
      .attr('font-size', '11px')
      .attr('fill', '#888780')
      .text('Puntuación adherencia dieta mediterránea');


    svgDieta2.append('text')
      .attr('x', W / 2).attr('y', 20)
      .attr('text-anchor', 'middle')
      .attr('font-size', '14px')
      .attr('font-weight', '500')
      .attr('fill', '#2c2c2a')
      .text('ICA por adherencia a la dieta mediterránea');

    return svgDieta2.node();

  } catch (err) {
    console.error('Error:', err);
  }
}

graficaDietaICA();

const svgDieta3 = d3.select('#dietaICC');

async function graficaDietaICC() {
  try {
    const response = await fetch('./index.php/home/dietaIcc/2344');
    const data = await response.json();
    const dataLimpia = data.filter(d => +d.icc > 0.7 && +d.icc < 1.1 && +d.dieta > 0);

    const W = 700, H = 400;
    const M = { top: 40, right: 20, bottom: 60, left: 60 };
    const iw = W - M.left - M.right;

    svgDieta3

      .attr('width', W)
      .attr('height', H)
      .attr('viewBox', [0, 0, W, H])
      .attr('style', 'max-width: 100%; height: auto;');

    const x = d3.scaleLinear()
      .domain([
        Math.floor(d3.min(dataLimpia, d => +d.dieta)) - 1,
        Math.ceil(d3.max(dataLimpia, d => +d.dieta)) + 1
      ])
      .nice()
      .range([M.left, W - M.right]);

    const y = d3.scaleLinear()
      .domain([
        Math.floor(d3.min(dataLimpia, d => +d.icc)) - 2,
        Math.ceil(d3.max(dataLimpia, d => +d.icc)) + 2
      ])
      .nice()
      .range([H - M.bottom, M.top]);

    // Grid horizontal
    svgDieta3
    .append('g')
      .attr('transform', `translate(${M.left}, 0)`)
      .call(d3.axisLeft(y).ticks(5).tickSize(-iw).tickFormat(''))
      .call(ax => ax.select('.domain').remove())
      .call(ax => ax.selectAll('.tick line').attr('stroke', 'rgba(0,0,0,0.07)'));

    // Puntos
    svgDieta3
    .selectAll('circle')
      .data(dataLimpia)
      .join('circle')
      .attr('cx', d => x(+d.dieta))
      .attr('cy', d => y(+d.icc))
      .attr('r', 4)
      .attr('fill', '#185FA5')
      .attr('opacity', 0.6);

    // Eje X
    svgDieta3
    .append('g')
      .attr('transform', `translate(0, ${H - M.bottom})`)
      .call(d3.axisBottom(x).ticks(8).tickSize(0))
      .call(ax => ax.select('.domain').attr('stroke', 'rgba(0,0,0,0.15)'))
      .call(ax => ax.selectAll('text').attr('font-size', '11px').attr('fill', '#888780'));

    // Eje Y
    svgDieta3
    .append('g')
      .attr('transform', `translate(${M.left}, 0)`)
      .call(d3.axisLeft(y).ticks(5).tickFormat(d => d.toFixed(1)))
      .call(ax => ax.select('.domain').remove())
      .call(ax => ax.selectAll('text').attr('font-size', '11px').attr('fill', '#888780'))
      .call(ax => ax.append('text')
        .attr('x', -M.left)
        .attr('y', 15)
        .attr('fill', 'currentColor')
        .attr('text-anchor', 'start')
        .text('↑ ICA (cintura/altura)'));

    
    svgDieta3
    .append('text')
      .attr('x', M.left + iw / 2)
      .attr('y', H - 10)
      .attr('text-anchor', 'middle')
      .attr('font-size', '11px')
      .attr('fill', '#888780')
      .text('Puntuación adherencia dieta mediterránea');


    svgDieta3
    .append('text')
      .attr('x', W / 2).attr('y', 20)
      .attr('text-anchor', 'middle')
      .attr('font-size', '14px')
      .attr('font-weight', '500')
      .attr('fill', '#2c2c2a')
      .text('ICC por adherencia a la dieta mediterránea');

    return svgDieta3
    .node();

  } catch (err) {
    console.error('Error:', err);
  }
}

graficaDietaICC();