@IBOutlet weak var activityIndicator: UIActivityIndicatorView!

func fetchData() {
    let url = "http://your_cxs_server.com/path/to/states.php"

    // 开始活动指示器的动画
    activityIndicator.startAnimating()

    AF.request(url).responseJSON { response in
        // 停止活动指示器的动画
        self.activityIndicator.stopAnimating()

        switch response.result {
        case .success(let value):
            if let jsonArray = value as? [[String: String]] {
                self.states = jsonArray
                self.tableView.reloadData()
            }
        case .failure(let error):
            print("Error: \(error)")
        }
    }
}
