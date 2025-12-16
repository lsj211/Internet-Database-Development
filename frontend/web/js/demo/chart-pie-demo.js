// 抗战纪念队数据配置
const memorialTeamData = {
    teamComposition: {
        labels: ["技术开发", "内容创作", "设计美工", "项目管理", "志愿者"],
        datasets: [{
            data: [35, 25, 20, 10, 10],
            backgroundColor: ['#8B0000', '#FFD700', '#228B22', '#4169E1', '#FF6347'],
            hoverBackgroundColor: ['#A52A2A', '#FFA500', '#32CD32', '#4682B4', '#FF7F50'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }]
    },
    teamAchievements: {
        labels: ["网站建设", "内容收集", "用户互动", "教育推广", "技术创新"],
        datasets: [{
            data: [40, 30, 15, 10, 5],
            backgroundColor: ['#DC143C', '#FFD700', '#228B22', '#4169E1', '#FF6347'],
            hoverBackgroundColor: ['#B22222', '#FFA500', '#32CD32', '#4682B4', '#FF7F50'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }]
    }
};

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.font.family = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.color = '#858796';

// Pie Chart Example - 使用团队组成数据
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: memorialTeamData.teamComposition,
  options: {
    maintainAspectRatio: false,
    plugins: {
      tooltip: {
        backgroundColor: "rgb(255,255,255)",
        bodyColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        padding: 15,
        displayColors: false,
        caretPadding: 10,
      },
      legend: {
        display: false
      }
    },
    cutout: '80%',
  },
});
